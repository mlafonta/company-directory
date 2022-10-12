import { ClickAwayListener, Grow, ListSubheader, MenuList, Paper, Popper } from '@mui/material';
import MenuItem from '@mui/material/MenuItem';
import * as React from 'react';
import { useEffect } from 'react';
import '../styles/AppBar.css';
import { ExpandLess, ExpandMore } from '@mui/icons-material';
import Button from '@mui/material/Button';
import { IResource } from '../models/IResource';
import axios from '../apis/companyDirectoryServer';
import useAxiosFunction from '../hooks/useAxiosFunction';

type ResourcesMenuButtonProps = {
    groupId: number;
};

const ResourcesMenuButton = ({ groupId }: ResourcesMenuButtonProps) => {
    const [anchorEl, setAnchorEl] = React.useState<null | HTMLElement>(null);
    const [open, setOpen] = React.useState<boolean>(false);
    const [response, error, loading, axiosFetch] = useAxiosFunction();
    const categories: string[] = [];
    const resources: IResource[] = [];
    const handleClick = (event: React.MouseEvent<HTMLButtonElement>) => {
        setAnchorEl(event.currentTarget);
        setOpen(true);
    };
    const handleClose = () => {
        setOpen(false);
    };

    const getData = () => {
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'GET',
            url: '/groups/' + groupId + '/resources',
        });
    };

    useEffect(() => {
        getData();
    }, []);

    if (!loading && !error && response) {
        // @ts-ignore
        response.forEach((item: IResource) => {
            if (item.active) {
                resources.push(item);
                if (!categories.includes(item.category!)) {
                    categories.push(item.category!);
                }
            }
        });
    }

    return (
        <>
            {loading && (
                <Button className="text" disabled sx={{ my: 2, color: 'white', display: 'flex' }}>
                    Resources <ExpandMore />
                </Button>
            )}
            {!loading && !error && response && (
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
                                            {categories.map((header) => (
                                                <div key={header}>
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
                                                            .map((filteredItem) => (
                                                                <MenuItem
                                                                    className="team-menu-text"
                                                                    key={filteredItem.id}
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
