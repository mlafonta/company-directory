import { IUser } from '../models/IUser';
import * as React from 'react';
import { Box, Button, Grid, Typography } from '@mui/material';
import IndeterminateCheckBoxOutlinedIcon from '@mui/icons-material/IndeterminateCheckBoxOutlined';
import AddBoxOutlinedIcon from '@mui/icons-material/AddBoxOutlined';

type DisplayDirectReportsProps = {
    reports: IUser[];
};

const DisplayDirectReports = ({ reports }: DisplayDirectReportsProps) => {
    const [open, setOpen] = React.useState<boolean>(true);
    const handleClick = () => {
        setOpen((prevOpen) => !prevOpen);
    };
    return (
        <>
            <Box style={{ display: 'flex', alignItems: 'safe center' }}>
                <Typography variant="h4" fontWeight="bold" sx={{ mb: 2 }}>
                    Direct Reports
                </Typography>
                <Button onClick={handleClick} color="inherit" sx={{ mb: 2 }}>
                    {open ? (
                        <IndeterminateCheckBoxOutlinedIcon sx={{ fontSize: 35 }} />
                    ) : (
                        <AddBoxOutlinedIcon sx={{ fontSize: 35 }} />
                    )}
                </Button>
            </Box>
            {open &&
                reports.map((report: IUser, key) => (
                    <Grid key={key} container spacing={1} justifyContent="left">
                        <Grid item xs={1}></Grid>
                        <Grid item xs={11}>
                            <Box
                                style={{ marginBottom: 10 }}
                                justifyContent="center"
                                flexDirection="column"
                                alignContent="center"
                            >
                                <Typography component="a" href={`/user/${report.id}`} variant="h5" display="block">
                                    {report.name}
                                </Typography>
                                <Typography variant="h6" display="block">
                                    {report.position}
                                </Typography>
                            </Box>
                        </Grid>
                    </Grid>
                ))}
        </>
    );
};
export default DisplayDirectReports;
