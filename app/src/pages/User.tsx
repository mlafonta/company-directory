import {useParams} from "react-router";
import KipsuAppBar from "../components/AppBar";
import * as React from "react";
import Footer from "../components/Footer";

const User = () => {
    const {id} = useParams();

    return(
        <>
        <h1>{id}</h1>
        </>
    )
}

export default User;