import * as React from "react";
import {useEffect} from "react";
import {useParams} from "react-router";
import {IGroup} from "../models/IGroup";
import axios from "../apis/companyDirectoryServer";
import useAxiosFunction from "../hooks/useAxiosFunction";
import '../styles/Group.css';
import {Container, Divider, Grid, LinearProgress, Link, Paper, Typography} from "@mui/material";
import DisplayTeamLead from "../components/DisplayTeamLead";
import DisplayTeamMembers from "../components/DisplayTeamMembers";
import DisplayChildTeams from "../components/DisplayChildTeams";
import GroupResourceDisplay from "../components/GroupResourceDisplay";

const Group = () => {
    const { id } = useParams();
    const [response, error, loading, axiosFetch] = useAxiosFunction();


    const getData = () => {
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'GET',
            url: '/groups/' + id
        });
    }
    useEffect(() => {
        getData();
    }, []);
    const emptyGroup: IGroup = {
    }
    let group: IGroup = response ? response as IGroup : emptyGroup
    return(
        <>  {error &&
            <h1>Page does not exist</h1>}
            {loading && <LinearProgress/>}
            {!loading &&
                <>
                    <Grid container spacing={2} mt={1}>
                        <Grid xs={8} item>
                            <Paper elevation={0} style={{textAlign: 'center', overflow: 'auto'}}>
                                <Container key={group.id}>
                                    <Typography className="title" variant="h2">
                                        {group?.name}
                                    </Typography>
                                    {/*don't love that this is hardcoded*/}
                                    {group?.parent?.id == 1 &&
                                        <Typography variant="h6" gutterBottom>
                                            Reports to: <Link href={`/user/1`}>CEO</Link>
                                        </Typography>}
                                    {group?.parent && group?.parent?.id != 1 &&
                                    <Typography variant="h6" gutterBottom>
                                        Reports to: <Link href={`${group?.parent?.id}`} variant={"inherit"}>{group?.parent?.name}</Link>
                                    </Typography>}
                                    <Typography variant="h5" gutterBottom mt={1}>
                                        {group?.description}
                                    </Typography>
                                    <DisplayTeamLead members={group?.members!} />
                                    {group?.children?.length! > 0 &&
                                        <DisplayChildTeams teams={group?.children!} />}
                                    {group?.members?.filter(x => !x.lead).length! > 0 &&
                                        <DisplayTeamMembers members={group?.members!} />}
                                </Container>
                            </Paper>
                        </Grid>
                        <Divider orientation="vertical" flexItem sx={{borderRightWidth: 5}} />
                        <Grid xs={3} item style={{maxHeight: '80vh', overflowY: "scroll"}}>
                            <GroupResourceDisplay group={group?.id!} />
                        </Grid>
                    </Grid>
                </>
            }
        </>
    );
};
export default Group;