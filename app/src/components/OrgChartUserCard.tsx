import { IUser } from '../models/IUser';
import * as React from 'react';
import { useEffect } from 'react';
import { Box, Button, CircularProgress, Grid, Paper, Typography } from '@mui/material';
import IndeterminateCheckBoxOutlinedIcon from '@mui/icons-material/IndeterminateCheckBoxOutlined';
import AddBoxOutlinedIcon from '@mui/icons-material/AddBoxOutlined';
import useAxiosFunction from '../hooks/useAxiosFunction';
import axios from '../apis/companyDirectoryServer';

type OrgChartUserCardProps = {
    userId: number;
};

const OrgChartUserCard = ({ userId }: OrgChartUserCardProps) => {
    const [open, setOpen] = React.useState<boolean>(false);
    const [response, error, loading, axiosFetch] = useAxiosFunction();
    const getData = () => {
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'GET',
            url: '/users/' + userId,
        });
    };
    useEffect(() => {
        getData();
    }, []);
    const emptyUser: IUser = {};
    const user: IUser = response ? (response as IUser) : emptyUser;
    const handleClick = () => {
        setOpen((prevOpen) => !prevOpen);
    };

    return (
        <Grid item>
            {loading && <CircularProgress />}
            {!loading && (
                <Box
                    sx={{
                        display: 'flex',
                        flexWrap: 'wrap',
                        '& > :not(style)': {
                            m: 1,
                            width: 128,
                            height: 128,
                        },
                    }}
                >
                    <Paper elevation={8}>
                        <Typography
                            variant="h4"
                            fontWeight="bold"
                            sx={{ mb: 2 }}
                            component="a"
                            href={`/user/${user?.id}`}
                        >
                            {user.name}
                        </Typography>
                        {user?.reports?.length! > 0 && (
                            <Button onClick={handleClick} color="inherit" sx={{ mb: 2 }}>
                                {open ? (
                                    <IndeterminateCheckBoxOutlinedIcon sx={{ fontSize: 35 }} />
                                ) : (
                                    <AddBoxOutlinedIcon sx={{ fontSize: 35 }} />
                                )}
                            </Button>
                        )}
                    </Paper>
                </Box>
            )}
            <Grid container item justifyContent="center" wrap="nowrap">
                {open &&
                    user?.reports?.map((report: IUser, key: number) => (
                        <OrgChartUserCard userId={report?.id!} key={key} />
                    ))}
            </Grid>
        </Grid>
    );
};
export default OrgChartUserCard;
