import {IResource} from "../models/IResource";
import {Box, Button, Grid, Link, Typography} from "@mui/material";
import React from "react";

type ResourceDisplayProps = {
    resource: IResource
}

const ResourceDisplay = ({resource}: ResourceDisplayProps) => {
    const [currentResource, setCurrentResource] = React.useState<IResource>(resource);
    const [edit, setEdit] = React.useState<boolean>(false);

    const makeEdit = () => {
        setEdit(true);
    }

    return (
        <>
            <Grid container spacing={1} justifyContent="left" overflow="scroll">
                <Grid item xs={1}>
                </Grid>
                <Grid item xs={7}>
                    {!edit &&
                        <Typography variant="h4">
                            <Link
                                component="a"
                                href={currentResource.url}
                                target="_blank"
                                variant="inherit"
                            >
                                {currentResource.name}
                            </Link>
                        </Typography>}
                </Grid>
                <Grid item xs={4} flexDirection="row">
                    {!edit &&
                        <Box>
                            <Button
                                variant="outlined"
                                disableElevation
                                onClick={makeEdit}
                                sx={{color: "#3e71ab", mb: 2, mr: 2}}>Edit
                            </Button>
                            <Button
                                variant="contained"
                                disableElevation
                                sx={{color: "#FFFFFF", backgroundColor: "#3e71ab", mb: 2}}>Delete
                            </Button>
                        </Box>}
                </Grid>
            </Grid>
            <Box sx={{ml: 10, mb: 2}}>
                {!edit &&
                    <Typography variant="h6" fontWeight="bold">
                        {currentResource.description}
                    </Typography>}
            </Box>
        </>
    );
}

export default ResourceDisplay;