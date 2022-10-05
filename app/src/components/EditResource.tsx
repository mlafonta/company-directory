import axios from "../apis/companyDirectoryServer";
import useAxiosFunction from "../hooks/useAxiosFunction";
import React, {useEffect, useState} from "react";
import {IResource} from "../models/IResource";
import '../styles/Group.css';
import {
    Box,
    Button, CircularProgress,
    FormControl,
    InputLabel,
    MenuItem,
    Select,
    SelectChangeEvent,
    TextField,
    Typography
} from "@mui/material";

type EditResourceProps = {
    resource: IResource
    refresh: any
}

const EditResource = ({resource, refresh}: EditResourceProps) => {
    const [response, error, loading, axiosFetch] = useAxiosFunction();
    const [id, setId] = useState<number>(resource.id!);
    const [name, setName] = useState<string>(resource.name!);
    const [description, setDescription] = useState<string>(resource.description!);
    const [url, setUrl] = useState<string>(resource.url!);
    const [category, setCategory] = useState<string>(resource.category!);
    let categories: string[] = [];

    const getData = () => {
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'GET',
            url: '/resources'
        });
    }
    useEffect(() => {
        getData();
    }, [refresh]);
    if (!loading && !error && response) {
        // @ts-ignore
        response.forEach((item: IResource) => {
            if (!categories.includes(item.category!)) {
                categories.push(item.category!)
            }
        });
    }

    const handleCategoryChange = (event: SelectChangeEvent) => {
        setCategory(event.target.value as string);
    }

    const handleNameChange = (event: React.ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
        setName(event.target.value);
    };
    const handleDescriptionChange = (event: React.ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
        setDescription(event.target.value);
    };
    const handleUrlChange = (event: React.ChangeEvent<HTMLTextAreaElement | HTMLInputElement>) => {
        setUrl(event.target.value);
    };

    const handleUrlBlur = (() => {
        if(!/^https*:\/\//.test(url) && url !=="") {
            setUrl('http://' + url);
        }
    });

    const cancel = () => {
        refresh();
    }
    const handleSubmit = (event: any) => {
        event.preventDefault();
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'PUT',
            url: '/resources/' + resource.id,
            requestConfig: {
                name,
                category,
                description,
                url,
                active: true
            }
        }).then(() => {
            refresh();
        })}
    return (
        <div>
            {loading && <CircularProgress />}
            {!loading && !error &&
            <div>
            <Typography variant="h5" className="form-header">Edit Resource</Typography>
            <form>
                <FormControl fullWidth sx={{mb: 3}}>
                    <InputLabel id="category-label">Category</InputLabel>
                    <Select
                        labelId="category-label"
                        id="category"
                        defaultValue={category}
                        value={category}
                        label="Category"
                        onChange={handleCategoryChange}
                    >
                        {categories.map((name:string, key:number) => (
                            <MenuItem key={key} value={name}>{name}</MenuItem>
                        ))}

                    </Select>
                </FormControl>
                <FormControl fullWidth sx={{mb: 3}}>
                    <TextField
                        required
                        variant="outlined"
                        value={name}
                        label="Resource Name"
                        onChange={handleNameChange}
                    />
                </FormControl>
                <FormControl fullWidth sx={{mb: 3}}>
                    <TextField
                        required
                        variant="outlined"
                        value={description}
                        label="Resource Description"
                        onChange={handleDescriptionChange}
                    />
                </FormControl>
                <FormControl fullWidth sx={{mb: 3}}>
                    <TextField
                        required
                        variant="outlined"
                        value={url}
                        label="Resource Url"
                        onChange={handleUrlChange}
                        onBlur={handleUrlBlur}
                    />
                </FormControl>
                    <Box display="flex" justifyContent="flex-end">
                        {name !== "" && url !== "" && description !== "" &&
                        <Button
                            onClick={handleSubmit}
                            variant="contained"
                            disableElevation
                            sx={{color: "#FFFFFF", backgroundColor: "#3e71ab", mb: 2}}>Submit
                        </Button>}
                        <Button
                            variant="outlined"
                            disableElevation
                            onClick={cancel}
                            sx={{color: "#3e71ab", mb: 2, ml: 2}}>Cancel
                        </Button>
                    </Box>
                </form>
            </div>}
        </div>
    )
}

export default EditResource;