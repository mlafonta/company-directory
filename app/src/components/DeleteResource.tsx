import axios from '../apis/companyDirectoryServer';
import { Box, Button, Typography } from '@mui/material';
import React from 'react';
import useAxiosFunction from '../hooks/useAxiosFunction';

type DeleteResourceProps = {
    resource: number;
    refresh: any;
    group: number;
};

const DeleteResource = ({ resource, refresh, group }: DeleteResourceProps) => {
    const [response, error, loading, axiosFetch] = useAxiosFunction();
    const cancel = () => {
        refresh();
    };
    const handleSubmit = (event: any) => {
        event.preventDefault();
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'DELETE',
            url: '/groups/' + group + '/resources/' + resource,
        }).then(() => {
            refresh();
        });
    };
    return (
        <>
            <Typography variant="h5" className="form-header">
                Are you sure you want to remove this resource?
            </Typography>
            <Box display="flex" justifyContent="flex-end">
                <Button
                    onClick={handleSubmit}
                    variant="contained"
                    disableElevation
                    sx={{ color: '#FFFFFF', backgroundColor: '#3e71ab', mb: 2 }}
                >
                    Yes
                </Button>
                <Button variant="outlined" disableElevation onClick={cancel} sx={{ color: '#3e71ab', mb: 2, ml: 2 }}>
                    Cancel
                </Button>
            </Box>
        </>
    );
};

export default DeleteResource;
