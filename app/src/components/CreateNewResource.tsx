import axios from '../apis/companyDirectoryServer';
import useAxiosFunction from '../hooks/useAxiosFunction';
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

type CreateNewResourceProps = {
    group: number;
    groupResources: IResource[];
    refresh: any;
};

const CreateNewResource = ({ group, groupResources, refresh }: CreateNewResourceProps) => {
    const [response, error, loading, axiosFetch] = useAxiosFunction();
    const [id, setId] = useState(0);
    const [name, setName] = useState('');
    const [description, setDescription] = useState('');
    const [url, setUrl] = useState('');
    const [category, setCategory] = useState('');
    const [resource, setResource] = useState('');
    const [resources, setResources] = useState<IResource[]>([]);
    const [initialResources, setInitialResources] = useState<IResource[]>([]);
    const categories: string[] = [];
    if (!loading && !error && response) {
        // @ts-ignore
        response.forEach((item: IResource) => {
            if (
                item.active &&
                !initialResources.includes(item) &&
                !groupResources.some((resource) => resource.id === item.id)
            ) {
                initialResources.push(item);
            }
            if (!categories.includes(item.category!)) {
                categories.push(item.category!);
            }
        });
    }
    const updateResources = () => {
        setResources(initialResources.filter((resource) => resource.category === category));
    };
    const getData = () => {
        setInitialResources([]);
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'GET',
            url: '/resources',
        });
    };
    useEffect(() => {
        getData();
    }, [refresh]);
    useEffect(() => {
        updateResources();
    }, [category]);

    const handleCategoryChange = (event: SelectChangeEvent) => {
        setCategory(event.target.value as string);
        setResource('');
    };
    const handleResourceChange = (event: SelectChangeEvent) => {
        setResource(event.target.value as string);
        if (event.target.value !== 'other') {
            setName(event.target.value as string);
            setDescription(
                initialResources.filter((resource) => resource.name === (event.target.value as string))[0].description!,
            );
            setId(initialResources.filter((resource) => resource.name === (event.target.value as string))[0].id!);
            setUrl(initialResources.filter((resource) => resource.name === (event.target.value as string))[0].url!);
        } else {
            setName('');
            setDescription('');
            setUrl('');
            setId(0);
        }
    };

    const handleNameChange = (event: React.ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
        setName(event.target.value);
    };
    const handleDescriptionChange = (event: React.ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
        setDescription(event.target.value);
    };
    const handleUrlChange = (event: React.ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
        setUrl(event.target.value);
    };

    const handleUrlBlur = () => {
        if (!/^https*:\/\//.test(url) && url !== '') {
            setUrl('http://' + url);
        }
    };

    const cancel = () => {
        refresh();
    };
    const handleSubmit = (event: any) => {
        event.preventDefault();
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'POST',
            url: '/groups/' + group + '/resources',
            requestConfig: {
                id,
                name,
                category,
                description,
                url,
                active: true,
            },
        }).then(() => {
            refresh();
        });
    };

    return (
        <div>
            {loading && <CircularProgress />}
            {!loading && !error && (
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
                                value={category}
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
                        {category !== '' && (
                            <FormControl fullWidth sx={{ mb: 3 }}>
                                <InputLabel id="resource-label">Resource</InputLabel>
                                <Select
                                    labelId="resource-label"
                                    id="resource"
                                    value={resource}
                                    label="Resource"
                                    onChange={handleResourceChange}
                                >
                                    {resources.map((resource: IResource, key: number) => (
                                        <MenuItem key={key} value={resource.name}>
                                            {resource.name}
                                        </MenuItem>
                                    ))}
                                    <MenuItem value="other">Other</MenuItem>
                                </Select>
                            </FormControl>
                        )}
                        {resource !== '' && (
                            <div>
                                <FormControl fullWidth sx={{ mb: 3 }}>
                                    <TextField
                                        required
                                        variant="outlined"
                                        value={name}
                                        label="Resource Name"
                                        onChange={handleNameChange}
                                        InputProps={{
                                            readOnly: name === resource && name !== 'other',
                                        }}
                                    />
                                </FormControl>
                                <FormControl fullWidth sx={{ mb: 3 }}>
                                    <TextField
                                        required
                                        variant="outlined"
                                        value={description}
                                        label="Resource Description"
                                        onChange={handleDescriptionChange}
                                        InputProps={{
                                            readOnly: name === resource && name !== 'other',
                                        }}
                                    />
                                </FormControl>
                                <FormControl fullWidth sx={{ mb: 3 }}>
                                    <TextField
                                        required
                                        variant="outlined"
                                        value={url}
                                        label="Resource Url"
                                        onChange={handleUrlChange}
                                        onBlur={handleUrlBlur}
                                        InputProps={{
                                            readOnly: name === resource && name !== 'other',
                                        }}
                                    />
                                </FormControl>
                            </div>
                        )}
                        <Box display="flex" justifyContent="flex-end">
                            {name !== '' && url !== '' && description !== '' && (
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
