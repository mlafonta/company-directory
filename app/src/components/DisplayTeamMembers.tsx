import { IUser } from '../models/IUser';
import React from 'react';
import { Container, Grid, Paper, Typography } from '@mui/material';

type DisplayTeamMembersProps = {
    members: IUser[];
};

const DisplayTeamMembers = ({ members }: DisplayTeamMembersProps) => {
    return (
        <Container>
            <Grid container spacing={2} justifyContent="center" sx={{ marginTop: 8 }}>
                <Grid item>
                    <Paper elevation={0} style={{ textAlign: 'left' }}>
                        <Typography variant="h4">Members:</Typography>
                    </Paper>
                </Grid>
                <Grid xs={8} item container justifyContent="center">
                    {members
                        .filter((leader) => !leader.lead)
                        .map((member: IUser, key) => (
                            <Grid
                                item
                                container
                                key={key}
                                xs={6}
                                style={{ marginBottom: 10 }}
                                justifyContent="center"
                                flexDirection="column"
                            >
                                <Typography
                                    className="list"
                                    component="a"
                                    href={`/user/${member.id}`}
                                    variant="h4"
                                    display="block"
                                >
                                    {member.name}
                                </Typography>
                                <Typography variant="h5" display="block">
                                    {member.position}
                                </Typography>
                            </Grid>
                        ))}
                </Grid>
                <Grid xs={2} item />
            </Grid>
        </Container>
    );
};

export default DisplayTeamMembers;
