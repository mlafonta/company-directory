import {ClickAwayListener, Grow, MenuList, Paper, Popper} from "@mui/material";
import MenuItem from "@mui/material/MenuItem";
import * as React from "react";
import '../styles/AppBar.css';
import {ExpandLess, ExpandMore} from "@mui/icons-material";
import Button from "@mui/material/Button";

type MenuButtonProps = {
    menuName: string
    menuItems: { [key:string]: any } []
    menuSource: string
}

const  MenuButton = ({menuName, menuItems, menuSource}: MenuButtonProps) => {
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
                    <Paper className="menu">
                        <ClickAwayListener onClickAway={handleClose}>
                            <MenuList
                                autoFocusItem={open}
                                id="composition-menu"
                                aria-labelledby="composition-button"
                            >
                                {menuItems.map((item) => (
                                    <MenuItem className="text" key={item.id} component="a" href={`/${menuSource}/${item.id}`}>{item.name}</MenuItem>
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

export default MenuButton;