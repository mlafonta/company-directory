import { useParams } from 'react-router';
import * as React from 'react';
import { Container, Divider, Grid, LinearProgress, Paper, Typography } from '@mui/material';
import { IUser } from '../models/IUser';
import DisplaySupervisor from '../components/DisplaySupervisor';
import DisplayDirectReports from '../components/DisplayDirectReports';
import { useGetUserQuery } from '../apis/apiSlice';
import AppBar from '../components/AppBar';
import Footer from '../components/Footer';

const User = () => {
    const { id } = useParams();
    const { data, isLoading, error } = useGetUserQuery(parseInt(id!));
    return (
        <>
            <AppBar />
            {error && <Typography variant="h3">Page does not exist</Typography>}
            {isLoading && <LinearProgress />}
            {!isLoading && !error && (
                <>
                    <Grid container spacing={2} mt={1}>
                        <Grid xs={8} item>
                            <Paper elevation={0} style={{ textAlign: 'center', overflow: 'auto', maxHeight: '80vh' }}>
                                <Container key={data?.id}>
                                    <Typography className="title" variant="h2" mb={2}>
                                        {data?.name}
                                    </Typography>
                                    <img
                                        src={data?.image}
                                        style={{ maxWidth: '75%', maxHeight: '45vh', marginBottom: '30px' }}
                                    />
                                    <Grid container spacing={2} mb={5}>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" fontWeight="bold">
                                                Position:
                                            </Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5">{data?.position}</Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" fontWeight="bold">
                                                Pronouns:
                                            </Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5">{data?.pronouns}</Typography>
                                        </Grid>
                                    </Grid>
                                    <Grid container spacing={2} mb={5}>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" fontWeight="bold">
                                                Team:
                                            </Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            {data?.group?.id === 1 && (
                                                <Typography variant="h5" component="a" href={`/`}>
                                                    {data?.group?.name}
                                                </Typography>
                                            )}
                                            {data?.group?.id !== 1 && (
                                                <Typography
                                                    variant="h5"
                                                    component="a"
                                                    href={`/group/${data?.group?.id}`}
                                                >
                                                    {data?.group?.name}
                                                </Typography>
                                            )}
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" fontWeight="bold">
                                                Slack:
                                            </Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography
                                                variant="h5"
                                                component="a"
                                                href={data?.slackLink}
                                                target="_blank"
                                            >
                                                @{data?.name}
                                            </Typography>
                                        </Grid>
                                    </Grid>
                                    <Grid container spacing={2} mb={5}>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" fontWeight="bold">
                                                Time at Kipsu:
                                            </Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5">{data?.timeAtKipsu}</Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" fontWeight="bold">
                                                Email
                                            </Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" component="a" href={`mailto:${data?.email}`}>
                                                {data?.email}
                                            </Typography>
                                        </Grid>
                                    </Grid>
                                </Container>
                            </Paper>
                        </Grid>
                        <Divider orientation="vertical" flexItem sx={{ borderRightWidth: 5 }} />
                        <Grid xs={3} item style={{ maxHeight: '80vh', overflowY: 'auto' }}>
                            {data?.supervisor && <DisplaySupervisor user={data} />}
                            {data?.reports?.length! > 0 && <DisplayDirectReports reports={data?.reports!} />}
                        </Grid>
                    </Grid>
                </>
            )}
            <Footer />
        </>
    );
};

export default User;
