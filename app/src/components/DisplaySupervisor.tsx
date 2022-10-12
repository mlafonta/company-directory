import { IUser } from '../models/IUser';
import * as React from 'react';
import { Box, Button, Grid, Typography } from '@mui/material';
import IndeterminateCheckBoxOutlinedIcon from '@mui/icons-material/IndeterminateCheckBoxOutlined';
import AddBoxOutlinedIcon from '@mui/icons-material/AddBoxOutlined';

type DisplaySupervisorProps = {
    user: IUser;
};

const DisplaySupervisor = ({ user }: DisplaySupervisorProps) => {
    const [open, setOpen] = React.useState<boolean>(true);
    const handleClick = () => {
        setOpen((prevOpen) => !prevOpen);
    };

    return (
        <>
            <Box style={{ display: 'flex', alignItems: 'safe center' }}>
                <Typography variant="h4" fontWeight="bold" sx={{ mb: 2 }}>
                    Supervisor
                </Typography>
                <Button onClick={handleClick} color="inherit" sx={{ mb: 2 }}>
                    {open ? (
                        <IndeterminateCheckBoxOutlinedIcon sx={{ fontSize: 35 }} />
                    ) : (
                        <AddBoxOutlinedIcon sx={{ fontSize: 35 }} />
                    )}
                </Button>
            </Box>
            {open && (
                <Grid container spacing={1} justifyContent="left">
                    <Grid item xs={1}></Grid>
                    <Grid item xs={11}>
                        <Box
                            style={{ marginBottom: 10 }}
                            justifyContent="center"
                            flexDirection="column"
                            alignContent="center"
                        >
                            <Typography
                                component="a"
                                href={`/user/${user?.supervisor?.id}`}
                                variant="h5"
                                display="block"
                            >
                                {user?.supervisor?.name}
                            </Typography>
                            <Typography variant="h6" display="block">
                                {user?.supervisor?.position}
                            </Typography>
                        </Box>
                    </Grid>
                </Grid>
            )}
        </>
    );
};
export default DisplaySupervisor;
