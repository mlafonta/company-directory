import {ClickAwayListener, Grow, ListItem, ListSubheader, MenuList, Paper, Popper} from "@mui/material";
import MenuItem from "@mui/material/MenuItem";
import * as React from "react";
import '../styles/AppBar.css';
import {ExpandLess, ExpandMore} from "@mui/icons-material";
import Button from "@mui/material/Button";
import {IGroup} from "../models/IGroup";
import {IResource} from "../models/IResource";

type ResourcesMenuButton = {
    menuName: string
    menuItems: IResource[]
    headers: string[]
}

const  ResourcesMenuButton = ({menuName, menuItems, headers}: ResourcesMenuButton) => {
    const [anchorEl, setAnchorEl] = React.useState<null | HTMLElement>(null);
    const [open, setOpen] = React.useState<boolean>(false);
    const handleClick = (event: React.MouseEvent<HTMLButtonElement>) => {
        setAnchorEl(event.currentTarget);
        setOpen(true);
    };
    const handleClose = () => {
        setOpen(false);
    };
    
    return(
        <>
        <Button
            className="text"
            onClick={handleClick}
            sx={{my: 2, color: 'white', display: 'flex'}}
        >
            {menuName}
            {open ? <ExpandLess /> : <ExpandMore />}
        </Button>
        <Popper
            open={open}
            anchorEl={anchorEl}
            placement="bottom-start"
            transition
            disablePortal
        >
            {({ TransitionProps, placement }) => (
                <Grow
                    {...TransitionProps}
                    style={{
                        transformOrigin:
                            placement === 'bottom-start' ? 'left top' : 'left bottom',
                    }}
                >
                    <Paper className="menu" style={{maxHeight: 375, overflow: 'auto'}} elevation={3}>
                        <ClickAwayListener onClickAway={handleClose}>
                            <MenuList
                                autoFocusItem={open}
                                id="composition-menu"
                                aria-labelledby="composition-button"
                            >
                                {headers.map((header) => (
                                    <>
                                        <ListSubheader className="resource-menu-header" key={header} color='inherit' >{header}</ListSubheader>
                                        <li>
                                            {menuItems.filter(item => item.category == header).map(filteredItem => (
                                                <MenuItem className="team-menu-text" key={filteredItem.id} component="a" href={filteredItem.url} target="_blank">{filteredItem.name}</MenuItem>
                                            ))}
                                        </li>
                                    </>
                                ))}
                            </MenuList>
                        </ClickAwayListener>
                    </Paper>
                </Grow>
            )}
        </Popper>
        </>
    );
};

export default ResourcesMenuButton;