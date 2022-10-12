import { IResource } from '../models/IResource';
import { Box, Button, Grid, Link, Typography } from '@mui/material';
import React from 'react';
import EditResource from './EditResource';
import DeleteResource from './DeleteResource';

type ResourceDisplayProps = {
    resource: IResource;
    refresh: any;
    group: number;
};

const ResourceDisplay = ({ resource, refresh, group }: ResourceDisplayProps) => {
    const [currentResource, setCurrentResource] = React.useState<IResource>(resource);
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
                <Grid item xs={1}></Grid>
                <Grid item xs={7}>
                    {!edit && !remove && (
                        <Typography variant="h4">
                            <Link component="a" href={currentResource.url} target="_blank" variant="inherit">
                                {currentResource.name}
                            </Link>
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
                        {currentResource.description}
                    </Typography>
                )}
                {edit && !remove && <EditResource resource={currentResource} refresh={refresh} />}
                {!edit && remove && <DeleteResource resource={currentResource.id!} refresh={refresh} group={group} />}
            </Box>
        </>
    );
};

export default ResourceDisplay;
