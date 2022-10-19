import { IResource } from '../models/IResource';
import { Box, Button, Typography } from '@mui/material';
import React from 'react';
import DisplayResource from './DisplayResource';
import IndeterminateCheckBoxOutlinedIcon from '@mui/icons-material/IndeterminateCheckBoxOutlined';
import AddBoxOutlinedIcon from '@mui/icons-material/AddBoxOutlined';

type CategoryDisplayProps = {
    category: string;
    resources: IResource[];
    groupId: number;
};

const DisplayCategory = ({ category, resources, groupId }: CategoryDisplayProps) => {
    const [open, setOpen] = React.useState<boolean>(false);
    const handleClick = () => {
        setOpen((prevOpen) => !prevOpen);
    };
    return (
        <>
            {category && (
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
            )}
            <Box>
                {open &&
                    resources
                        .filter((item) => item.category == category)
                        .map((filteredItem) => (
                            <DisplayResource resource={filteredItem} key={filteredItem.id} groupId={groupId} />
                        ))}
            </Box>
        </>
    );
};

export default DisplayCategory;
