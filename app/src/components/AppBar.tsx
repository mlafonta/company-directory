import * as React from 'react';
import '../styles/AppBar.css';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import MenuIcon from '@mui/icons-material/Menu';
import Button from '@mui/material/Button';
import Link from '@mui/material/Link';
import { ClickAwayListener, Grow, InputBase, MenuList, Paper, Popper } from '@mui/material';
import { Search } from '@mui/icons-material';
import MenuButtonWithIcon from './MenuButtonWithIcon';
import { alpha, styled } from '@mui/material/styles';
import SearchIcon from '@mui/icons-material/Search';
import TeamsMenuButton from './TeamsMenuButton';
import ResourcesMenuButton from './ResourcesMenuButton';

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
    return (
        <>
            <AppBar position="static" className="appBar" elevation={0}>
                <Toolbar disableGutters>
                    <Link href="/">
                        <Box sx={{ display: { xs: 'none', md: 'flex' }, mr: 1 }}>
                            <img src="/images/Kipsu-Logo.png" alt="Kipsu Logo" className="logo" />
                        </Box>
                    </Link>
                    {/*/!* Hamburger Menu *!/*/}
                    {/*<Box sx={{flexGrow: 1, display: {xs: 'flex', md: 'none'}}}>*/}
                    {/*    <Button*/}
                    {/*        id="composition-button"*/}
                    {/*        disabled*/}
                    {/*        aria-controls={open ? 'composition-menu' : undefined}*/}
                    {/*        aria-expanded={open ? 'true' : undefined}*/}
                    {/*        aria-haspopup="true"*/}
                    {/*        onClick={handleClick}*/}
                    {/*    >*/}
                    {/*        <MenuIcon className="icons"/>*/}
                    {/*    </Button>*/}
                    {/*    <Popper*/}
                    {/*        anchorEl={anchorEl}*/}
                    {/*        open={open}*/}
                    {/*        placement="bottom-start"*/}
                    {/*        transition*/}
                    {/*        disablePortal*/}
                    {/*    >*/}
                    {/*        {({TransitionProps, placement}) => (*/}
                    {/*            <Grow*/}
                    {/*                {...TransitionProps}*/}
                    {/*                style={{*/}
                    {/*                    transformOrigin:*/}
                    {/*                        placement === 'bottom-start' ? 'left top' : 'left',*/}
                    {/*                }}*/}
                    {/*            >*/}
                    {/*                <Paper className="hamburger-menu">*/}
                    {/*                    <ClickAwayListener onClickAway={handleClose}>*/}
                    {/*                        <MenuList*/}
                    {/*                            id="composition-menu"*/}
                    {/*                            aria-labelledby="composition-button"*/}
                    {/*                        >*/}
                    {/*                        </MenuList>*/}
                    {/*                    </ClickAwayListener>*/}
                    {/*                </Paper>*/}
                    {/*            </Grow>*/}
                    {/*        )}*/}
                    {/*    </Popper>*/}
                    {/*</Box>*/}
                    {/* Site Name for small screens */}
                    {/*<Box sx={{flexGrow: 1, display: {xs: 'flex', md: 'none'}, mt: 2}}>*/}
                    <Box m="auto" sx={{ display: { xs: 'flex', md: 'none' }, mt: 4 }}>
                        <Link href="/" color="inherit" style={{ textDecoration: 'none' }}>
                            <Typography className="link">Kipsu Company Directory</Typography>
                        </Link>
                    </Box>
                    {/* Dropdown Menus */}
                    <Box sx={{ flexGrow: 1, display: { xs: 'none', md: 'flex' } }}>
                        <TeamsMenuButton />
                        <ResourcesMenuButton groupId={1} />
                        {/*<Button href="\org-chart" className="text" sx={{color: "#FFFFFF"}}>Org Chart</Button>*/}
                    </Box>
                    {/*/!* Search Bar *!/*/}
                    {/*<Box sx={{display: {xs: 'none', s: 'none', md: 'flex'}}}>*/}
                    {/*    <Search>*/}
                    {/*        <SearchIconWrapper>*/}
                    {/*            <SearchIcon/>*/}
                    {/*        </SearchIconWrapper>*/}
                    {/*        <StyledInputBase*/}
                    {/*            placeholder="Search…"*/}
                    {/*            inputProps={{'aria-label': 'search'}}*/}
                    {/*        />*/}
                    {/*    </Search>*/}
                    {/*</Box>*/}
                    {/*/!* Account Dropdown *!/*/}
                    {/*<Box sx={{flexGrow: 0, mx: 3}}>*/}
                    {/*    <MenuButtonWithIcon menuItems={settings}/>*/}
                    {/*</Box>*/}
                </Toolbar>
            </AppBar>
        </>
    );
};
export default KipsuAppBar;
