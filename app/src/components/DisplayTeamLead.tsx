import { IUser } from '../models/IUser';
import React, { useEffect } from 'react';
import '../styles/Group.css';
import { Container, Grid, Paper, Typography } from '@mui/material';

type DisplayTeamLeadProps = {
    members: IUser[];
};

const DisplayTeamLead = ({ members }: DisplayTeamLeadProps) => {
    return (
        <Container>
            <Grid container spacing={2} justifyContent="center" sx={{ marginTop: 8 }}>
                <Grid xs={2} item>
                    <Paper elevation={0} style={{ textAlign: 'center' }}>
                        <Typography variant="h4">Lead:</Typography>
                    </Paper>
                </Grid>
                <Grid xs={8} item container justifyContent="center">
                    <Paper elevation={0} style={{ textAlign: 'center' }}>
                        {members
                            .filter((leader) => leader.lead)
                            .map((lead: IUser, key) => (
                                <div key={key}>
                                    <Typography className="list" component="a" href={`/user/${lead.id}`} variant="h4">
                                        {lead.name}
                                    </Typography>
                                    <Typography variant="h5">{lead.position}</Typography>
                                </div>
                            ))}
                    </Paper>
                </Grid>
                <Grid xs={2} item />
            </Grid>
        </Container>
    );
};

export default DisplayTeamLead;
