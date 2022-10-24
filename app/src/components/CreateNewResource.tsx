import React, { useEffect, useState } from 'react';
import { IResource } from '../models/IResource';
import '../styles/Group.css';
import {
    Box,
    Button,
    CircularProgress,
    FormControl,
    InputLabel,
    MenuItem,
    Select,
    SelectChangeEvent,
    TextField,
    Typography,
} from '@mui/material';
import { useAddResourceToGroupMutation, useGetResourcesQuery } from '../redux/apiSlice';

type CreateNewResourceProps = {
    groupId: number;
    groupResources: IResource[];
    setCreate: any;
};

const CreateNewResource = ({ groupId, groupResources, setCreate }: CreateNewResourceProps) => {
    const [addResource] = useAddResourceToGroupMutation();
    const { data, isLoading, error } = useGetResourcesQuery(undefined);
    const [newResource, setNewResource] = useState<IResource>({
        id: 0,
        name: '',
        category: '',
        description: '',
        url: '',
        active: true,
    });
    const [resources, setResources] = useState<IResource[]>([]);
    const [other, setOther] = useState<boolean>(false);
    const [open, setOpen] = useState<boolean>(false);
    const [categories, setCategories] = React.useState<string[]>([]);
    const updateResources = () => {
        setResources(
            data?.filter(
                (dataResource) =>
                    dataResource.category === newResource.category &&
                    dataResource.active &&
                    !groupResources.some((resource) => resource.id === dataResource.id),
            )!,
        );
    };

    useEffect(() => {
        setCategories(
            data?.map((resource) => resource.category!)
                ? [...new Set(data?.map((resource) => resource.category!))]
                : [],
        );
    }, [data]);

    useEffect(() => {
        updateResources();
    }, [newResource.category, data]);

    const handleCategoryChange = (event: SelectChangeEvent) => {
        setNewResource({
            id: 0,
            name: '',
            category: event.target.value as string,
            description: '',
            url: '',
            active: true,
        });
        setOpen(false);
        setOther(false);
    };
    const handleResourceChange = (event: SelectChangeEvent) => {
        if (event.target.value !== 'Other') {
            setNewResource({
                ...newResource,
                id: data?.filter((dataResource) => dataResource.name === (event.target.value as string))[0].id!,
                name: event.target.value as string,
                description: data?.filter((dataResource) => dataResource.name === (event.target.value as string))[0]
                    .description!,
                url: data?.filter((dataResource) => dataResource.name === (event.target.value as string))[0].url!,
            });
            setOther(false);
        } else {
            setNewResource({
                ...newResource,
                id: 0,
                name: '',
                description: '',
                url: '',
            });
            setOther(true);
        }
        setOpen(true);
    };

    const handleNameChange = (event: React.ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
        setNewResource({ ...newResource, name: event.target.value });
    };
    const handleDescriptionChange = (event: React.ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
        setNewResource({ ...newResource, description: event.target.value });
    };
    const handleUrlChange = (event: React.ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
        setNewResource({ ...newResource, url: event.target.value });
    };

    const handleUrlBlur = () => {
        if (!/^https*:\/\//.test(newResource.url!) && newResource.url !== '') {
            setNewResource({ ...newResource, url: 'http://' + newResource.url });
        }
    };

    const cancel = () => {
        setCreate(false);
    };
    const handleSubmit = async () => {
        await addResource({ resource: newResource, groupId: groupId });
        setCreate(false);
    };

    return (
        <div>
            {isLoading && <CircularProgress />}
            {!isLoading && !error && (
                <div>
                    <Typography variant="h5" className="form-header">
                        Add New Resource
                    </Typography>
                    <form>
                        <FormControl fullWidth sx={{ mb: 3 }}>
                            <InputLabel id="category-label">Category</InputLabel>
                            <Select
                                labelId="category-label"
                                id="category"
                                value={newResource.category}
                                label="Category"
                                onChange={handleCategoryChange}
                            >
                                {categories.map((name: string, key: number) => (
                                    <MenuItem key={key} value={name}>
                                        {name}
                                    </MenuItem>
                                ))}
                            </Select>
                        </FormControl>
                        {newResource.category !== '' && (
                            <FormControl fullWidth sx={{ mb: 3 }}>
                                <InputLabel id="resource-label">Resource</InputLabel>
                                <Select
                                    labelId="resource-label"
                                    id="resource"
                                    value={other ? 'Other' : newResource.name}
                                    label="Resource"
                                    onChange={handleResourceChange}
                                >
                                    {resources.map((resource: IResource, key: number) => (
                                        <MenuItem key={key} value={resource.name}>
                                            {resource.name}
                                        </MenuItem>
                                    ))}
                                    <MenuItem value="Other">Other</MenuItem>
                                </Select>
                            </FormControl>
                        )}
                        {open && (
                            <div>
                                <FormControl fullWidth sx={{ mb: 3 }}>
                                    <TextField
                                        required
                                        variant="outlined"
                                        value={newResource.name}
                                        label="Resource Name"
                                        onChange={handleNameChange}
                                        InputProps={{
                                            readOnly:
                                                data?.filter((dataResource) => dataResource.name === newResource.name)
                                                    ?.length! > 0,
                                        }}
                                    />
                                </FormControl>
                                <FormControl fullWidth sx={{ mb: 3 }}>
                                    <TextField
                                        required
                                        variant="outlined"
                                        value={newResource.description}
                                        label="Resource Description"
                                        onChange={handleDescriptionChange}
                                        InputProps={{
                                            readOnly:
                                                data?.filter((dataResource) => dataResource.name === newResource.name)
                                                    ?.length! > 0,
                                        }}
                                    />
                                </FormControl>
                                <FormControl fullWidth sx={{ mb: 3 }}>
                                    <TextField
                                        required
                                        variant="outlined"
                                        value={newResource.url}
                                        label="Resource Url"
                                        onChange={handleUrlChange}
                                        onBlur={handleUrlBlur}
                                        InputProps={{
                                            readOnly:
                                                data?.filter((dataResource) => dataResource.name === newResource.name)
                                                    ?.length! > 0,
                                        }}
                                    />
                                </FormControl>
                            </div>
                        )}
                        <Box display="flex" justifyContent="flex-end">
                            {newResource.name !== '' && newResource.url !== '' && newResource.description !== '' && (
                                <Button
                                    onClick={handleSubmit}
                                    variant="contained"
                                    disableElevation
                                    sx={{ color: '#FFFFFF', backgroundColor: '#3e71ab', mb: 2 }}
                                >
                                    Submit
                                </Button>
                            )}
                            <Button
                                variant="outlined"
                                disableElevation
                                onClick={cancel}
                                sx={{ color: '#3e71ab', mb: 2, ml: 2 }}
                            >
                                Cancel
                            </Button>
                        </Box>
                    </form>
                </div>
            )}
        </div>
    );
};

export default CreateNewResource;
