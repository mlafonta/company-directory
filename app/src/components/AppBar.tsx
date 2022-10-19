import * as React from 'react';
import '../styles/AppBar.css';
import AppBar from '@mui/material/AppBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import Button from '@mui/material/Button';
import Link from '@mui/material/Link';
import TeamsMenuButton from './TeamsMenuButton';
import ResourcesMenuButton from './ResourcesMenuButton';
import DynamicSearchBar from './DynamicSearchBar';

const KipsuAppBar = () => {
    return (
        <>
            <AppBar position="static" className="appBar" elevation={0}>
                <Toolbar disableGutters>
                    <Link href="/">
                        <Box sx={{ display: { xs: 'none', md: 'flex' }, mr: 1 }}>
                            <img src="/images/Kipsu-Logo.png" alt="Kipsu Logo" className="logo" />
                        </Box>
                    </Link>
                    <Box m="auto" sx={{ display: { xs: 'flex', md: 'none' }, mt: 4 }}>
                        <Link href="/" color="inherit" style={{ textDecoration: 'none' }}>
                            <Typography className="link">Kipsu Company Directory</Typography>
                        </Link>
                    </Box>
                    {/* Dropdown Menus */}
                    <Box sx={{ flexGrow: 1, display: { xs: 'none', md: 'flex' } }}>
                        <TeamsMenuButton />
                        <ResourcesMenuButton groupId={1} />
                        <Button href="\org-chart" className="text" sx={{ color: '#FFFFFF' }}>
                            Org Chart
                        </Button>
                    </Box>
                    {/*/!* Search Bar *!/*/}
                    <Box
                        sx={{ display: { xs: 'none', s: 'none', md: 'flex' }, flexGrow: 1 }}
                        alignItems="right"
                        justifyContent="center"
                    >
                        <DynamicSearchBar />
                    </Box>
                </Toolbar>
            </AppBar>
        </>
    );
};
export default KipsuAppBar;
