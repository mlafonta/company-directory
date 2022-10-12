import { Container, Typography } from '@mui/material';
import * as React from 'react';
import '../styles/Home.css';

const Home = () => {
    return (
        <>
            <Container disableGutters maxWidth="xl">
                <Typography className="home-title" variant="h1" align="center" gutterBottom>
                    Welcome to the
                    <br />
                    Kipsu Company Directory
                </Typography>
                <Typography variant="h4" align="center" gutterBottom>
                    Here you can find information on every department, team and individual at Kipsu. Each page will also
                    contain hierarchical information as well as relevant{/*slacks and */} resources. Additionally, you
                    can access company wide resources
                    {/*and interact with the dynamic organizational*/}
                    {/*chart*/}
                    . <br />
                    Anything you could expect from a company directory, you can find it here!
                </Typography>
            </Container>
        </>
    );
};
export default Home;
