import React, { useEffect, useState } from 'react';
import { IResource } from '../models/IResource';
import '../styles/Group.css';
import { useGetResourcesQuery, useUpdateResourceMutation } from '../redux/apiSlice';
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

type EditResourceProps = {
    resource: IResource;
    setEdit: any;
};

const EditResource = ({ resource, setEdit }: EditResourceProps) => {
    const { data, isLoading, error } = useGetResourcesQuery(undefined);
    const [updateResource] = useUpdateResourceMutation();
    const [editedResource, setEditedResource] = useState<IResource>(resource);
    const [categories, setCategories] = React.useState<string[]>([]);

    useEffect(() => {
        setCategories(
            data?.map((resource) => resource.category!)
                ? [...new Set(data?.map((resource) => resource.category!))]
                : [],
        );
        setEditedResource(resource);
    }, [data]);

    const handleChange = (event: React.ChangeEvent<HTMLTextAreaElement | HTMLInputElement> | SelectChangeEvent) => {
        setEditedResource({ ...editedResource, [event.target.name]: event.target.value });
    };

    const handleUrlBlur = () => {
        if (!/^https*:\/\//.test(editedResource.url!) && editedResource.url !== '') {
            setEditedResource({ ...editedResource, url: 'http://' + editedResource.url });
        }
    };
    const cancel = () => {
        setEdit(false);
    };
    const handleSubmit = async () => {
        await updateResource(editedResource);
        setEdit(false);
    };
    return (
        <div>
            {isLoading && <CircularProgress />}
            {!isLoading && !error && (
                <div>
                    <Typography variant="h5" className="form-header">
                        Edit Resource
                    </Typography>
                    <form>
                        <FormControl fullWidth sx={{ mb: 3 }}>
                            <InputLabel id="category-label">Category</InputLabel>
                            <Select
                                labelId="category-label"
                                id="category"
                                value={editedResource.category}
                                label="Category"
                                name="category"
                                onChange={handleChange}
                            >
                                {categories.map((name: string, key: number) => (
                                    <MenuItem key={key} value={name}>
                                        {name}
                                    </MenuItem>
                                ))}
                            </Select>
                        </FormControl>
                        <FormControl fullWidth sx={{ mb: 3 }}>
                            <TextField
                                required
                                variant="outlined"
                                value={editedResource.name}
                                label="Resource Name"
                                name="name"
                                onChange={handleChange}
                            />
                        </FormControl>
                        <FormControl fullWidth sx={{ mb: 3 }}>
                            <TextField
                                required
                                variant="outlined"
                                value={editedResource.description}
                                label="Resource Description"
                                name="description"
                                onChange={handleChange}
                            />
                        </FormControl>
                        <FormControl fullWidth sx={{ mb: 3 }}>
                            <TextField
                                required
                                variant="outlined"
                                value={editedResource.url}
                                label="Resource Url"
                                name="url"
                                onChange={handleChange}
                                onBlur={handleUrlBlur}
                            />
                        </FormControl>
                        <Box display="flex" justifyContent="flex-end">
                            {editedResource.name !== '' &&
                                editedResource.url !== '' &&
                                editedResource.description !== '' && (
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

export default EditResource;
