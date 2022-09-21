import { Container, Typography} from "@mui/material";
import KipsuAppBar from "../components/AppBar";
import * as React from "react";
import '../styles/Home.css';
import Footer from "../components/Footer";


const Home = () => {
    return (
        <>
            <KipsuAppBar/>
            <Container disableGutters maxWidth="xl">
                <Typography className="title" variant="h1" align="center" gutterBottom>
                    Welcome to the<br/>Kipsu Company Directory
                </Typography>
                <Typography variant="h4" align="center" gutterBottom>
                    Here you can find information on every department, team and individual at Kipsu.
                    Each page will also contain hierarchical information as well as relevant slacks and resources.
                    Additionally, you can access company wide resources and interact with the dynamic organizational
                    chart. <br/>
                    Anything you could expect from a company directory, you can find it here!
                </Typography>
            </Container>
            <Footer/>
        </>
    );
};
 export default Home;