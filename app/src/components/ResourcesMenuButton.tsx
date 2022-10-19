import { ClickAwayListener, Grow, ListSubheader, MenuList, Paper, Popper } from '@mui/material';
import MenuItem from '@mui/material/MenuItem';
import * as React from 'react';
import '../styles/AppBar.css';
import { ExpandLess, ExpandMore } from '@mui/icons-material';
import Button from '@mui/material/Button';
import { IResource } from '../models/IResource';
import { useGetResourcesByGroupQuery } from '../apis/apiSlice';
import { useEffect, useState } from 'react';

type ResourcesMenuButtonProps = {
    groupId: number;
};

const ResourcesMenuButton = ({ groupId }: ResourcesMenuButtonProps) => {
    const [anchorEl, setAnchorEl] = React.useState<null | HTMLElement>(null);
    const [open, setOpen] = React.useState<boolean>(false);
    const { data, isLoading, error } = useGetResourcesByGroupQuery(groupId);
    const [categories, setCategories] = React.useState<string[]>([]);
    const [resources, setResources] = useState<IResource[]>([]);
    const handleClick = (event: React.MouseEvent<HTMLButtonElement>) => {
        setAnchorEl(event.currentTarget);
        setOpen(true);
    };
    const handleClose = () => {
        setOpen(false);
    };

    useEffect(() => {
        setCategories(
            data?.map((resource) => resource.category!)
                ? [...new Set(data?.map((resource) => resource.category!))]
                : [],
        );
        setResources(data?.filter((dataResource) => dataResource.active)!);
    }, [data]);

    return (
        <>
            {isLoading && (
                <Button className="text" disabled sx={{ my: 2, color: 'white', display: 'flex' }}>
                    Resources <ExpandMore />
                </Button>
            )}
            {!isLoading && !error && data && (
                <>
                    <Button className="text" onClick={handleClick} sx={{ my: 2, color: 'white', display: 'flex' }}>
                        Resources
                        {open ? <ExpandLess /> : <ExpandMore />}
                    </Button>
                    <Popper open={open} anchorEl={anchorEl} placement="bottom-start" transition disablePortal>
                        {({ TransitionProps, placement }) => (
                            <Grow
                                {...TransitionProps}
                                style={{
                                    transformOrigin: placement === 'bottom-start' ? 'left top' : 'left bottom',
                                }}
                            >
                                <Paper className="menu" style={{ maxHeight: 375, overflow: 'auto' }} elevation={3}>
                                    <ClickAwayListener onClickAway={handleClose}>
                                        <MenuList
                                            autoFocusItem={open}
                                            id="composition-menu"
                                            aria-labelledby="composition-button"
                                        >
                                            {categories.map((header, key) => (
                                                <div key={key}>
                                                    <ListSubheader
                                                        className="resource-menu-header"
                                                        key={header}
                                                        color="inherit"
                                                    >
                                                        {header}
                                                    </ListSubheader>
                                                    <li>
                                                        {resources
                                                            .filter((item) => item.category == header)
                                                            .map((filteredItem, key) => (
                                                                <MenuItem
                                                                    className="team-menu-text"
                                                                    key={key}
                                                                    component="a"
                                                                    href={filteredItem.url}
                                                                    target="_blank"
                                                                >
                                                                    {filteredItem.name}
                                                                </MenuItem>
                                                            ))}
                                                    </li>
                                                </div>
                                            ))}
                                        </MenuList>
                                    </ClickAwayListener>
                                </Paper>
                            </Grow>
                        )}
                    </Popper>
                </>
            )}
        </>
    );
};

export default ResourcesMenuButton;
