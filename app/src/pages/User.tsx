import { useParams } from 'react-router';
import * as React from 'react';
import { useEffect } from 'react';
import useAxiosFunction from '../hooks/useAxiosFunction';
import axios from '../apis/companyDirectoryServer';
import { Container, Divider, Grid, LinearProgress, Paper, Typography } from '@mui/material';
import { IUser } from '../models/IUser';
import DisplaySupervisor from '../components/DisplaySupervisor';
import DisplayDirectReports from '../components/DisplayDirectReports';

const User = () => {
    const { id } = useParams();
    const [response, error, loading, axiosFetch] = useAxiosFunction();

    const getData = () => {
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'GET',
            url: '/users/' + id,
        });
    };
    useEffect(() => {
        getData();
    }, []);
    const emptyUser: IUser = {};
    const user: IUser = response ? (response as IUser) : emptyUser;
    return (
        <>
            {' '}
            {error && <h1>Page does not exist</h1>}
            {loading && <LinearProgress />}
            {!loading && (
                <>
                    <Grid container spacing={2} mt={1}>
                        <Grid xs={8} item>
                            <Paper elevation={0} style={{ textAlign: 'center', overflow: 'auto', maxHeight: '80vh' }}>
                                <Container key={user.id}>
                                    <Typography className="title" variant="h2" mb={2}>
                                        {user?.name}
                                    </Typography>
                                    <img
                                        src={user?.image}
                                        style={{ maxWidth: '75%', maxHeight: '45vh', marginBottom: '30px' }}
                                    />
                                    <Grid container spacing={2} mb={5}>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" fontWeight="bold">
                                                Position:
                                            </Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5">{user?.position}</Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" fontWeight="bold">
                                                Pronouns:
                                            </Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5">{user?.pronouns}</Typography>
                                        </Grid>
                                    </Grid>
                                    <Grid container spacing={2} mb={5}>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" fontWeight="bold">
                                                Team:
                                            </Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" component="a" href={`/group/${user?.group?.id}`}>
                                                {user?.group?.name}
                                            </Typography>
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
                                                href={user?.slackLink}
                                                target="_blank"
                                            >
                                                @{user?.name}
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
                                            <Typography variant="h5">{user?.timeAtKipsu}</Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" fontWeight="bold">
                                                Email
                                            </Typography>
                                        </Grid>
                                        <Grid xs={3} item>
                                            <Typography variant="h5" component="a" href={`mailto:${user?.email}`}>
                                                {user?.email}
                                            </Typography>
                                        </Grid>
                                    </Grid>
                                </Container>
                            </Paper>
                        </Grid>
                        <Divider orientation="vertical" flexItem sx={{ borderRightWidth: 5 }} />
                        <Grid xs={3} item style={{ maxHeight: '80vh', overflowY: 'auto' }}>
                            {user?.supervisor && <DisplaySupervisor user={user} />}
                            {user?.reports?.length! > 0 && <DisplayDirectReports reports={user?.reports!} />}
                        </Grid>
                    </Grid>
                </>
            )}
        </>
    );
};

export default User;
