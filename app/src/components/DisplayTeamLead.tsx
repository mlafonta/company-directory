import { IUser } from '../models/IUser';
import React, { useEffect } from 'react';
import '../styles/Group.css';
import { Container, Grid, Paper, Typography } from '@mui/material';

type DisplayTeamLeadProps = {
    members: IUser[];
};

const DisplayTeamLead = ({ members }: DisplayTeamLeadProps) => {
    const [member, setMember] = React.useState<IUser[]>(members);
    const [lead, setLead] = React.useState<IUser[]>();
    const [loading, setLoading] = React.useState<boolean>(true);
    useEffect(() => {
        if (member != undefined) {
            setLead(member.filter((leader) => leader.lead));
            setLoading(false);
        }
    }, [member]);
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
                        {!loading &&
                            lead?.map((lead: IUser, key) => (
                                <div key={key}>
                                    <Typography className="list" component="a" href={`/user/${lead.id}`} variant="h4">
                                        {lead.name}
                                    </Typography>
                                    <Typography variant="h5">{lead.position}</Typography>
                                </div>
                            ))}
                    </Paper>
                </Grid>
                <Grid xs={2} item></Grid>
            </Grid>
        </Container>
    );
};

export default DisplayTeamLead;
