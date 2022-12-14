import { IResource } from '../models/IResource';
import { Box, Button, Grid, Link, Typography } from '@mui/material';
import React from 'react';
import EditResource from './EditResource';
import DeleteResource from './DeleteResource';

type DisplayResourceProps = {
    resource: IResource;
    groupId: number;
};

const DisplayResource = ({ resource, groupId }: DisplayResourceProps) => {
    const [edit, setEdit] = React.useState<boolean>(false);
    const [remove, setRemove] = React.useState<boolean>(false);

    const makeEdit = () => {
        setEdit(true);
    };

    const executeRemove = () => {
        setRemove(true);
    };

    return (
        <>
            <Grid container spacing={1} justifyContent="left">
                <Grid item xs={1} />
                <Grid item xs={7}>
                    {!edit && !remove && (
                        <Typography variant="h4" component="a" href={resource.url} target="_blank">
                            {resource.name}
                        </Typography>
                    )}
                </Grid>
                <Grid item xs={4} flexDirection="row">
                    {!edit && !remove && (
                        <Box>
                            <Button
                                variant="outlined"
                                disableElevation
                                onClick={makeEdit}
                                sx={{ color: '#3e71ab', mb: 2, mr: 2 }}
                            >
                                Edit
                            </Button>
                            <Button
                                variant="contained"
                                disableElevation
                                onClick={executeRemove}
                                sx={{ color: '#FFFFFF', backgroundColor: '#3e71ab', mb: 2 }}
                            >
                                Delete
                            </Button>
                        </Box>
                    )}
                </Grid>
            </Grid>
            <Box sx={{ ml: 10, mb: 2 }}>
                {!edit && !remove && (
                    <Typography variant="h6" fontWeight="bold">
                        {resource.description}
                    </Typography>
                )}
                {edit && !remove && <EditResource resource={resource} setEdit={setEdit} />}
                {!edit && remove && (
                    <DeleteResource resourceId={resource.id!} setRemove={setRemove} groupId={groupId} />
                )}
            </Box>
        </>
    );
};

export default DisplayResource;
