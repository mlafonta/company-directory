import { IGroup } from '../models/IGroup';
import React, { useEffect } from 'react';
import { Container, Grid, Paper, Typography } from '@mui/material';

type DisplayChildTeamsProps = {
    teams: IGroup[];
};

const DisplayChildTeams = ({ teams }: DisplayChildTeamsProps) => {
    const [team, setTeams] = React.useState<IGroup[]>(teams);
    const [loading, setLoading] = React.useState<boolean>(true);
    useEffect(() => {
        if (team != undefined) {
            setLoading(false);
        }
    }, [team]);
    return (
        <Container>
            <Grid container spacing={2} justifyContent="center" sx={{ marginTop: 8 }} maxHeight="20vh">
                <Grid xs={2} item>
                    <Paper elevation={0} style={{ textAlign: 'center' }}>
                        <Typography variant="h4">Teams:</Typography>
                    </Paper>
                </Grid>
                <Grid xs={8} item container justifyContent="center">
                    {!loading &&
                        team?.map((team: IGroup, key) => (
                            <Grid item container key={key} xs={6} style={{ marginBottom: 10 }} justifyContent="center">
                                <Typography className="list" component="a" href={`/group/${team.id}`} variant="h4">
                                    {team.name}
                                </Typography>
                            </Grid>
                        ))}
                </Grid>
                <Grid xs={2} item></Grid>
            </Grid>
        </Container>
    );
};
export default DisplayChildTeams;
