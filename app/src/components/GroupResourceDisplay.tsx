import * as React from "react";
import {useEffect} from "react";
import useAxiosFunction from "../hooks/useAxiosFunction";
import {IResource} from "../models/IResource";
import axios from "../apis/companyDirectoryServer";
import {Box, Button, CircularProgress, Grid, Typography} from "@mui/material";
import AddBoxOutlinedIcon from '@mui/icons-material/AddBoxOutlined';
import IndeterminateCheckBoxOutlinedIcon from '@mui/icons-material/IndeterminateCheckBoxOutlined';
import CreateNewResource from "./CreateNewResource";
import CategoryDisplay from "./CategoryDisplay";

type GroupResourceDisplayProps = {
    group: number
}
const GroupResourceDisplay = ({group}: GroupResourceDisplayProps) => {
    const [response, error, loading, axiosFetch] = useAxiosFunction();
    const [open, setOpen] = React.useState<boolean>(false);
    const [create, setCreate] = React.useState<boolean>(false);
    const [resources, setResources] = React.useState<IResource[]>([]);
    const [categories, setCategories] = React.useState<string[]>([]);
    const [refresh, setRefresh] = React.useState<boolean>(false);

    const handleClick = () => {
        setOpen(prevOpen => !prevOpen);

    };
    const createNewResource = () => {
        setCreate(true);
    }


    const getData = () => {
        setResources([]);
        setCategories([]);
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'GET',
            url: '/groups/' + group + '/resources'
        });
    }

    const executeRefresh = () => {
        setRefresh(prevRefresh => !prevRefresh);
        setCreate(false);
    }

    useEffect(() => {
        getData();
    }, [refresh]);

    if (!loading && !error && response) {
        // @ts-ignore
        response.forEach((item: IResource) => {
            if (item.active && !resources.some(resource =>resource.id === item.id)) {
                resources.push(item)
                if (!categories.includes(item.category!)) {
                    categories.push(item.category!)
                }
            }
        });
    }

    return (
        <>
        {loading && <CircularProgress />}
        {!loading && !error &&
        <Box style={{maxHeight: '100vh', overflowY: "scroll"}}>
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
                        sx={{color: "#FFFFFF", backgroundColor: "#3e71ab", mb: 2}}>+ Add New Resource
                    </Button>
                </Grid>
            </Grid>
            <Box>
                {open && categories.length === 0 &&
                <Typography variant="h4" className="resource-menu-header">No Resources Currently Added to this Group</Typography> }
                {open && categories.map((category, key) => (
                    <div key={key}>
                        <CategoryDisplay category={category} resources={resources} refresh={executeRefresh} group={group}/>
                    </div>
                ))}
                {create &&
                    <CreateNewResource  group={group} groupResources={resources} refresh={executeRefresh}/>}
            </Box>
        </Box>}
        </>
    );
}

export default GroupResourceDisplay;