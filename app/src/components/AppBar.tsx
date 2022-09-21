import * as React from 'react';
import '../styles/AppBar.css';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import MenuIcon from '@mui/icons-material/Menu';
import Button from '@mui/material/Button';
import MenuItem from '@mui/material/MenuItem';
import Link from '@mui/material/Link';
import {
    ClickAwayListener,
    Grow, InputBase,
    MenuList, Paper,
    Popper,
} from "@mui/material";
import {Search} from "@mui/icons-material";
import {NestedMenuItem} from "mui-nested-menu";
import MenuButton from "./MenuButton";
import MenuButtonWithIcon from "./MenuButtonWithIcon";
import { styled, alpha } from '@mui/material/styles';
import SearchIcon from '@mui/icons-material/Search';
import {useEffect} from "react";
import axios from "axios";
import {Group} from "../models/Group";

const placeholderDepartments = [{"name": "Engineering", "id":1}, {"name": "Finance", "id":2} ];
const placeholderTeams = [{"name": "Squad K", "id":3}, {"name": "Onboarding", "id":4} ];
const placeholderResources = [{"name": "Jira", "id":1, "url": "https://kipsudev.atlassian.net/jira/your-work"} ];
const settings = ['My Profile', 'Logout'];

const KipsuAppBar = () => {
    const [anchorEl, setAnchorEl] = React.useState<null | HTMLElement>(null);
    const [open, setOpen] = React.useState<boolean>(false);
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

    let teams: Array<Group> = [];
    let departments: Array<Group> = [];
    let resources = [];
    async function fetchGroups() {
        try {
            const response = await axios.get('http://localhost:8000/api/v1/groups');
            console.log(response.data)
            response.data.forEach((item: string) => {
                let groupObj = JSON.parse(item)
                let group = groupObj as Group
                if (group.type == 'team') {
                    teams.push(groupObj);
                } else if (group.type == 'department') {
                    departments.push(groupObj);
                }
            });
        } catch (error) {
            console.error(error);
        }
    }
    useEffect(() => {
        fetchGroups();
    }, []);

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
                                                    {departments.map((Group) => (
                                                        <MenuItem className="text" key={Group.id} component="a" href={`/group/${Group.id}`}>{Group.name}</MenuItem>
                                                    ))}
                                            </NestedMenuItem>
                                            <NestedMenuItem
                                                label="Teams"
                                                parentMenuOpen={open}
                                            >
                                                {teams.map((Group) => (
                                                    <MenuItem className="text" key={Group.id} component="a" href={`/group/${Group.id}`}>{Group.name}</MenuItem>
                                                ))}
                                            </NestedMenuItem>
                                            <NestedMenuItem
                                                label="Resources"
                                                parentMenuOpen={open}
                                            >
                                                {placeholderResources.map((item) => (
                                                    <MenuItem className="text" component="a" href={`/resource/${item.id}`}>{item.name}</MenuItem>
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
                    <MenuButton menuName="Departments" menuItems={departments} menuSource="group"/>
                    <MenuButton menuName="Teams" menuItems={teams} menuSource="group" />
                    <MenuButton menuName="Resources" menuItems={placeholderResources} menuSource="resource"/>
                    <Button href="\org-chart" className="text" sx={{ color: "#FFFFFF" }}>Org Chart</Button>
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
