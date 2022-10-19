import * as React from 'react';
import { useParams } from 'react-router';
import '../styles/Group.css';
import { Container, Divider, Grid, LinearProgress, Paper, Typography } from '@mui/material';
import DisplayTeamLead from '../components/DisplayTeamLead';
import DisplayTeamMembers from '../components/DisplayTeamMembers';
import DisplayChildTeams from '../components/DisplayChildTeams';
import DisplayGroupResource from '../components/DisplayGroupResource';
import { useGetGroupQuery } from '../apis/apiSlice';
import Footer from '../components/Footer';
import AppBar from '../components/AppBar';

const Group = () => {
    const { id } = useParams();
    const { data, isLoading, error } = useGetGroupQuery(parseInt(id!));
    return (
        <>
            <AppBar />
            {error && <h1>Page does not exist</h1>}
            {isLoading && <LinearProgress />}
            {!isLoading && !error && (
                <>
                    <Grid container spacing={2} mt={1}>
                        <Grid xs={8} item>
                            <Paper elevation={0} style={{ textAlign: 'center', overflow: 'auto' }}>
                                <Container key={data?.id}>
                                    <Typography className="title" variant="h2">
                                        {data?.name}
                                    </Typography>
                                    {/*don't love that this is hardcoded*/}
                                    {data?.parent?.id == 1 && (
                                        <Typography variant="h6" gutterBottom>
                                            Reports to:{' '}
                                            <Typography component="a" href={`/user/1`} variant="h6">
                                                CEO
                                            </Typography>
                                        </Typography>
                                    )}
                                    {data?.parent && data?.parent?.id != 1 && (
                                        <Typography variant="h6" gutterBottom>
                                            Reports to:{' '}
                                            <Typography href={`${data?.parent?.id}`} component="a" variant="h6">
                                                {data?.parent?.name}
                                            </Typography>
                                        </Typography>
                                    )}
                                    <Typography variant="h5" gutterBottom mt={1}>
                                        {data?.description}
                                    </Typography>
                                    {data?.members?.filter((member) => member.lead).length! > 0 && (
                                        <DisplayTeamLead members={data?.members!} />
                                    )}
                                    {data?.children?.length! > 0 && <DisplayChildTeams teams={data?.children!} />}
                                    {data?.members?.filter((member) => !member.lead).length! > 0 && (
                                        <DisplayTeamMembers members={data?.members!} />
                                    )}
                                </Container>
                            </Paper>
                        </Grid>
                        <Divider orientation="vertical" flexItem sx={{ borderRightWidth: 5 }} />
                        <Grid xs={3} item style={{ maxHeight: '80vh', overflowY: 'auto' }}>
                            <DisplayGroupResource groupId={data?.id!} />
                        </Grid>
                    </Grid>
                </>
            )}
            <Footer />
        </>
    );
};
export default Group;
