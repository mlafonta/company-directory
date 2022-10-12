import { IResource } from '../models/IResource';
import { Box, Button, Typography } from '@mui/material';
import React from 'react';
import ResourceDisplay from './ResourceDisplay';
import IndeterminateCheckBoxOutlinedIcon from '@mui/icons-material/IndeterminateCheckBoxOutlined';
import AddBoxOutlinedIcon from '@mui/icons-material/AddBoxOutlined';

type CategoryDisplayProps = {
    category: string;
    resources: IResource[];
    refresh: any;
    group: number;
};

const CategoryDisplay = ({ category, resources, refresh, group }: CategoryDisplayProps) => {
    const [open, setOpen] = React.useState<boolean>(false);
    const handleClick = () => {
        setOpen((prevOpen) => !prevOpen);
    };
    return (
        <>
            <Box style={{ display: 'flex', alignItems: 'safe center' }}>
                <Typography className="resource-menu-header" color="inherit" sx={{ mb: 2 }}>
                    {category}
                </Typography>
                <Button onClick={handleClick} color="inherit" sx={{ mb: 2 }}>
                    {open ? (
                        <IndeterminateCheckBoxOutlinedIcon sx={{ fontSize: 30 }} />
                    ) : (
                        <AddBoxOutlinedIcon sx={{ fontSize: 30 }} />
                    )}
                </Button>
            </Box>
            <Box>
                {open &&
                    resources
                        .filter((item) => item.category == category)
                        .map((filteredItem) => (
                            <ResourceDisplay
                                resource={filteredItem}
                                key={filteredItem.id}
                                refresh={refresh}
                                group={group}
                            />
                        ))}
            </Box>
        </>
    );
};

export default CategoryDisplay;
