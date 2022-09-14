import {ClickAwayListener, Grow, MenuList, Paper, Popper} from "@mui/material";
import MenuItem from "@mui/material/MenuItem";
import * as React from "react";
import '../styles/AppBar.css';
import PersonIcon from "@mui/icons-material/Person";
import IconButton from "@mui/material/IconButton";

type MenuButtonWithIconProps = {
    menuItems: Array<string>
}

const  MenuButtonWithIcon = ({ menuItems}: MenuButtonWithIconProps) => {
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
        <IconButton onClick={handleClick} sx={{ p: 0 }}>
            <PersonIcon className="icons" sx={{ display: { xs: 'flex', md: 'none' }}}/>
            <PersonIcon className="icons-no-margin"sx={{ display: { xs: 'none', md: 'flex' }}}/>
        </IconButton>
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
                        transformOrigin: 'right top',
                    }}
                >
                    <Paper className="menu">
                        <ClickAwayListener onClickAway={handleClose}>
                            <MenuList
                                autoFocusItem={open}
                                id="composition-menu"
                                aria-labelledby="composition-button"
                            >
                                {menuItems.map((item) => (
                                    <MenuItem className="text" onClick={handleClose}>{item}</MenuItem>
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

export default MenuButtonWithIcon;