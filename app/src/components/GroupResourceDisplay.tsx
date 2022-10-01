import * as React from "react";
import {useEffect} from "react";
import useAxiosFunction from "../hooks/useAxiosFunction";
import {IResource} from "../models/IResource";
import axios from "../apis/companyDirectoryServer";
import {Box, Button, Grid, Typography} from "@mui/material";
import AddBoxOutlinedIcon from '@mui/icons-material/AddBoxOutlined';
import IndeterminateCheckBoxOutlinedIcon from '@mui/icons-material/IndeterminateCheckBoxOutlined';
import ResourceDisplay from "./ResourceDisplay";
import CreateNewResource from "./CreateNewResource";

type GroupResourceDisplayProps = {
    group: number
}
const GroupResourceDisplay = ({group}: GroupResourceDisplayProps) => {
    const [response, error, loading, axiosFetch] = useAxiosFunction();
    const [open, setOpen] = React.useState<boolean>(false);
    const [create, setCreate] = React.useState<boolean>(false);
    let categories: string[] = [];
    let resources: IResource[] = [];
    const handleClick = () => {
        setOpen(prevOpen => !prevOpen);
    };
    const createNewResource = () => {
        setOpen(true);
        setCreate(true);
    }

    const getData = () => {
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'GET',
            url: '/groups/' + group + '/resources'
        });
    }

    useEffect(() => {
        getData();
    }, []);
    if (!loading && !error && response) {
        // @ts-ignore
        response.forEach((item: IResource) => {
            if (item.active) {
                resources.push(item)
                if (!categories.includes(item.category)) {
                    categories.push(item.category)
                }
            }
        });
    }
    return (
        <>
        {!loading && !error &&
        <>
            <Grid container style={{ display: "flex", alignItems: "safe center" }}>
                <Grid item xs={6}>
                    <Box style={{ display: "flex", alignItems: "safe center" }}>
                        <Typography variant="h4" fontWeight="bold" sx={{mb: 2}}>
                            Resources
                        </Typography>
                        <Button
                            onClick={handleClick}
                            color="inherit"
                            sx={{mb: 2}}
                        >
                            {open ? <IndeterminateCheckBoxOutlinedIcon sx={{ fontSize: 35 }}/> : <AddBoxOutlinedIcon sx={{ fontSize: 35 }}/> }
                        </Button>
                    </Box>
                </Grid>
                <Grid item xs={6}>
                    <Button
                        variant="contained"
                        disableElevation
                        onClick={createNewResource}
                        sx={{color: "#FFFFFF", backgroundColor: "#3e71ab", mb: 2}}>+ Create New Resource
                    </Button>
                </Grid>
            </Grid>
            <Box>
                {open && categories.map((header, key) => (
                    <div key={key}>
                        <Typography className="resource-menu-header" key={header}
                                    color='inherit' sx={{mb: 1}}>{header}</Typography>
                        {resources.filter(item => item.category == header).map(filteredItem => (
                            <ResourceDisplay resource={filteredItem} key={filteredItem.id}/>
                        ))}
                        {create &&
                            <CreateNewResource  />}
                    </div>
                ))}

            </Box>
        </>}
        </>
    );
}

export default GroupResourceDisplay;