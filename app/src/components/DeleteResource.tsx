import { Box, Button, Typography } from '@mui/material';
import React from 'react';
import { useDeleteResourceFromGroupMutation } from '../redux/apiSlice';

type DeleteResourceProps = {
    resourceId: number;
    setRemove: any;
    groupId: number;
};

const DeleteResource = ({ resourceId, setRemove, groupId }: DeleteResourceProps) => {
    const [deleteResource] = useDeleteResourceFromGroupMutation();

    const cancel = () => {
        setRemove(false);
    };
    const handleSubmit = () => {
        deleteResource({ groupId: groupId, resourceId: resourceId });
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
