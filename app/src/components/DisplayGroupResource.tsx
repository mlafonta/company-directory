import * as React from 'react';
import { useEffect } from 'react';
import { Box, Button, CircularProgress, Grid, Typography } from '@mui/material';
import AddBoxOutlinedIcon from '@mui/icons-material/AddBoxOutlined';
import IndeterminateCheckBoxOutlinedIcon from '@mui/icons-material/IndeterminateCheckBoxOutlined';
import CreateNewResource from './CreateNewResource';
import DisplayCategory from './DisplayCategory';
import { useGetResourcesByGroupQuery } from '../apis/apiSlice';

type GroupResourceDisplayProps = {
    groupId: number;
};
const DisplayGroupResource = ({ groupId }: GroupResourceDisplayProps) => {
    const { data, isLoading, error } = useGetResourcesByGroupQuery(groupId);
    const [open, setOpen] = React.useState<boolean>(false);
    const [create, setCreate] = React.useState<boolean>(false);
    const [categories, setCategories] = React.useState<string[]>([]);

    const handleClick = () => {
        setOpen((prevOpen) => !prevOpen);
    };
    const createNewResource = () => {
        setCreate(true);
    };

    useEffect(() => {
        setCategories(
            data?.map((resource) => resource.category!)
                ? [...new Set(data?.map((resource) => resource.category!))]
                : [],
        );
    }, [data]);

    return (
        <>
            {isLoading && <CircularProgress />}
            {!isLoading && !error && (
                <Box>
                    <Grid container style={{ display: 'flex', alignItems: 'safe center' }}>
                        <Grid item xs={6}>
                            <Box style={{ display: 'flex', alignItems: 'safe center' }}>
                                <Typography variant="h4" fontWeight="bold" sx={{ mb: 2 }}>
                                    Resources
                                </Typography>
                                <Button onClick={handleClick} color="inherit" sx={{ mb: 2 }}>
                                    {open ? (
                                        <IndeterminateCheckBoxOutlinedIcon sx={{ fontSize: 35 }} />
                                    ) : (
                                        <AddBoxOutlinedIcon sx={{ fontSize: 35 }} />
                                    )}
                                </Button>
                            </Box>
                        </Grid>
                        <Grid item xs={6}>
                            <Button
                                variant="contained"
                                disableElevation
                                onClick={createNewResource}
                                sx={{ color: '#FFFFFF', backgroundColor: '#3e71ab', mb: 2 }}
                            >
                                + Add New Resource
                            </Button>
                        </Grid>
                    </Grid>
                    <Box>
                        {open && categories.length < 1 && (
                            <Typography variant="h4" className="resource-menu-header">
                                No Resources Currently Added to this Group
                            </Typography>
                        )}
                        {open &&
                            categories.map((category, key) => (
                                <div key={key}>
                                    <DisplayCategory
                                        category={category}
                                        resources={data?.filter((resource) => resource.active)!}
                                        groupId={groupId}
                                    />
                                </div>
                            ))}
                        {create && (
                            <CreateNewResource
                                groupId={groupId}
                                groupResources={data?.filter((resource) => resource.active)!}
                                setCreate={setCreate}
                            />
                        )}
                    </Box>
                </Box>
            )}
        </>
    );
};

export default DisplayGroupResource;
