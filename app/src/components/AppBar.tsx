import * as React from 'react';
import '../styles/AppBar.css';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import IconButton from '@mui/material/IconButton';
import Typography from '@mui/material/Typography';
import Menu from '@mui/material/Menu';
import MenuIcon from '@mui/icons-material/Menu';
import Button from '@mui/material/Button';
import MenuItem from '@mui/material/MenuItem';
import Link from '@mui/material/Link';
import PersonIcon from '@mui/icons-material/Person';
import ArrowDropDownIcon from '@mui/icons-material/ArrowDropDown';
import {
    Autocomplete,
    ClickAwayListener,
    Collapse,
    Grow, InputBase,
    List,
    ListItem,
    ListItemButton,
    ListItemIcon,
    ListItemText,
    MenuList, Paper,
    Popper, responsiveFontSizes, TextField
} from "@mui/material";
import {ExpandLess, ExpandMore, Search} from "@mui/icons-material";
import {NestedMenuItem} from "mui-nested-menu";
import MenuButton from "./MenuButton";
import MenuButtonWithIcon from "./MenuButtonWithIcon";
import { styled, alpha } from '@mui/material/styles';
import SearchIcon from '@mui/icons-material/Search';

const placeholderDepartments = ['Engineering', 'Customer Success', 'Finance'];
const placeholderTeams = ['Squad K', 'Customer Support', 'Finance'];
const placeholderResources = ['Employee Handbook', 'Jira', 'Confluence'];
const settings = ['My Profile', 'Logout'];

const KipsuAppBar = () => {
    const [anchorEl, setAnchorEl] = React.useState<null | HTMLElement>(null);
    const [open, setOpen] = React.useState<boolean>(false);
    const [myOptions, setMyOptions] = React.useState<Array<string>>([]);
    const handleClick = (event: React.MouseEvent<HTMLButtonElement>) => {
        setAnchorEl(event.currentTarget);
        setOpen(true);
    };
    const handleClose = () => {
        setOpen(false);

    };

    const Search = styled('div')(({ theme }) => ({
        position: 'relative',
        borderRadius: theme.shape.borderRadius,
        backgroundColor: alpha(theme.palette.common.white, 0.15),
        '&:hover': {
            backgroundColor: alpha(theme.palette.common.white, 0.25),
        },
        marginLeft: 0,
        width: '100%',
        [theme.breakpoints.up('sm')]: {
            marginLeft: theme.spacing(1),
            width: 'auto',
        },
    }));

    const SearchIconWrapper = styled('div')(({ theme }) => ({
        padding: theme.spacing(0, 2),
        height: '100%',
        position: 'absolute',
        pointerEvents: 'none',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
    }));

    const StyledInputBase = styled(InputBase)(({ theme }) => ({
        color: 'inherit',
        '& .MuiInputBase-input': {
            padding: theme.spacing(1, 1, 1, 0),
            // vertical padding + font size from searchIcon
            paddingLeft: `calc(1em + ${theme.spacing(4)})`,
            transition: theme.transitions.create('width'),
            width: '100%',
            [theme.breakpoints.up('sm')]: {
                width: '12ch',
                '&:focus': {
                    width: '20ch',
                },
            },
        },
    }));

    return (
        <AppBar position="static" className="appBar" elevation={0}>
            <Toolbar disableGutters>
                <Link href="/">
                    <Box sx={{ display: { xs: 'none', md: 'flex' }, mr: 1}}>
                        <img src='/images/Kipsu-Logo.png' className="logo" />
                    </Box>
                </Link>
                {/* Hamburger Menu */}
                <Box sx={{ flexGrow: 1, display: { xs: 'flex', md: 'none' } }}>
                    <Button
                        id="composition-button"
                        aria-controls={open ? 'composition-menu' : undefined}
                        aria-expanded={open ? 'true' : undefined}
                        aria-haspopup="true"
                        onClick={handleClick}
                    >
                        <MenuIcon className="icons" />
                    </Button>
                    <Popper
                        anchorEl={anchorEl}
                        open={open}
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
                                            id="composition-menu"
                                            aria-labelledby="composition-button"
                                        >
                                            <NestedMenuItem
                                                label="Departments"
                                                parentMenuOpen={open}
                                            >
                                                    {placeholderDepartments.map((department) => (
                                                        <MenuItem className="text" onClick={handleClose}>{department}</MenuItem>
                                                    ))}
                                            </NestedMenuItem>
                                            <NestedMenuItem
                                                label="Teams"
                                                parentMenuOpen={open}
                                            >
                                                {placeholderTeams.map((team) => (
                                                    <MenuItem className="text" onClick={handleClose}>{team}</MenuItem>
                                                ))}
                                            </NestedMenuItem>
                                            <NestedMenuItem
                                                label="Resources"
                                                parentMenuOpen={open}
                                            >
                                                {placeholderResources.map((resource) => (
                                                    <MenuItem className="text" onClick={handleClose}>{resource}</MenuItem>
                                                ))}
                                            </NestedMenuItem>
                                        </MenuList>
                                    </ClickAwayListener>
                                </Paper>
                            </Grow>
                        )}
                    </Popper>
                </Box>
                {/* Site Name for small screens */}
                <Box sx={{ flexGrow: 1, display: { xs: 'flex', md: 'none' }, mt: 2 }}>
                    <Link href="/" color="inherit" style={{ textDecoration: 'none' }}>
                        <Typography className="link">Kipsu Company Directory</Typography>
                    </Link>
                </Box>
                {/* Dropdown Menus */}
                <Box sx={{ flexGrow: 1, display: { xs: 'none', md: 'flex' } }}>
                    <MenuButton menuName="Departments" menuItems={placeholderDepartments} />
                    <MenuButton menuName="Teams" menuItems={placeholderTeams} />
                    <MenuButton menuName="Resources" menuItems={placeholderResources} />
                </Box>
                {/* Search Bar */}
                <Box sx={{ display: { xs: 'none', s: 'none', md: 'flex' } }}>
                    <Search>
                        <SearchIconWrapper>
                            <SearchIcon />
                        </SearchIconWrapper>
                        <StyledInputBase
                            placeholder="Search…"
                            inputProps={{ 'aria-label': 'search' }}
                        />
                    </Search>
                </Box>
                {/* Account Dropdown */}
                <Box sx={{ flexGrow: 0, mx: 3}}>
                    <MenuButtonWithIcon menuItems={settings} />
                </Box>
            </Toolbar>
        </AppBar>
    );
};
export default KipsuAppBar;
