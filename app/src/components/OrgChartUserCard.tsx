import { IUser } from '../models/IUser';
import * as React from 'react';
import { Button, Card, CardActions, CardContent, CardHeader, CircularProgress, Typography } from '@mui/material';
import { useGetUserQuery } from '../redux/apiSlice';
import IndeterminateCheckBoxOutlinedIcon from '@mui/icons-material/IndeterminateCheckBoxOutlined';
import AddBoxOutlinedIcon from '@mui/icons-material/AddBoxOutlined';
import { TreeNode } from 'react-organizational-chart';

type OrgChartUserCardProps = {
    userId: number;
};

const OrgChartUserCard = ({ userId }: OrgChartUserCardProps) => {
    const [open, setOpen] = React.useState<boolean>(false);
    const { data, isLoading, error } = useGetUserQuery(userId);
    const handleClick = () => {
        setOpen((prevOpen) => !prevOpen);
    };

    return (
        <>
            {isLoading && <TreeNode label={<CircularProgress />} />}
            {!isLoading && !error && data?.reports?.length! > 0 && (
                <TreeNode
                    label={
                        <Card
                            elevation={3}
                            style={{
                                width: 200,
                                textAlign: 'center',
                                display: 'inline-block',
                            }}
                        >
                            {data?.lead && data?.id !== 1 && (
                                <CardHeader
                                    title={data?.group?.name}
                                    style={{ textAlign: 'center' }}
                                    component="a"
                                    href={`/group/${data?.group?.id}`}
                                />
                            )}
                            {data?.lead && data?.id === 1 && (
                                <CardHeader
                                    title={data?.group?.name}
                                    style={{ textAlign: 'center' }}
                                    component="a"
                                    href={`/`}
                                />
                            )}
                            {!data?.lead && (
                                <CardHeader title={data?.position} style={{ textAlign: 'center', spacing: 10 }} />
                            )}
                            <CardContent>
                                <img src={data?.image} style={{ maxWidth: '90%' }} />
                                {data?.lead && <Typography variant="subtitle1">{data?.position}</Typography>}
                                <Typography variant="subtitle1" component="a" href={`/user/${data?.id}`}>
                                    {data?.name}
                                </Typography>
                            </CardContent>
                            <CardActions
                                style={{ display: 'flex', justifyContent: 'space-around', marginBottom: 'auto' }}
                            >
                                {data?.reports?.length! > 0 && (
                                    <Button onClick={handleClick} color="inherit" sx={{ mb: 2 }}>
                                        {open ? (
                                            <IndeterminateCheckBoxOutlinedIcon sx={{ fontSize: 30 }} />
                                        ) : (
                                            <AddBoxOutlinedIcon sx={{ fontSize: 30 }} />
                                        )}
                                    </Button>
                                )}
                            </CardActions>
                        </Card>
                    }
                >
                    {open &&
                        data?.reports?.map((report: IUser, key: number) => (
                            <OrgChartUserCard userId={report?.id!} key={key} />
                        ))}
                </TreeNode>
            )}

            {!isLoading && data?.reports?.length === 0 && (
                <TreeNode
                    label={
                        <Card
                            elevation={3}
                            style={{
                                borderRadius: 12,
                                width: 200,
                                textAlign: 'center',
                                display: 'inline-block',
                            }}
                        >
                            {data?.lead && data?.id !== 1 && (
                                <CardHeader
                                    title={data?.group?.name}
                                    style={{ textAlign: 'center' }}
                                    component="a"
                                    href={`/group/${data?.group?.id}`}
                                />
                            )}
                            {data?.lead && data?.id === 1 && (
                                <CardHeader
                                    title={data?.group?.name}
                                    style={{ textAlign: 'center' }}
                                    component="a"
                                    href={`/`}
                                />
                            )}
                            {!data?.lead && (
                                <CardHeader title={data?.position} style={{ textAlign: 'center', spacing: 10 }} />
                            )}
                            <CardContent>
                                <img src={data?.image} style={{ maxWidth: '90%' }} />
                                {data?.lead && <Typography variant="subtitle1">{data?.position}</Typography>}
                                <Typography variant="subtitle1" component="a" href={`/user/${data?.id}`}>
                                    {data?.name}
                                </Typography>
                            </CardContent>
                        </Card>
                    }
                />
            )}
        </>
    );
};
export default OrgChartUserCard;
