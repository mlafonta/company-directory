import KipsuAppBar from "../components/AppBar";
import * as React from "react";
import Footer from "../components/Footer";
import {useParams} from "react-router";
import {IGroup} from "../models/IGroup";


const Group = () => {
    const placeholderDepartment: IGroup = {
        id: 7,
        name: 'Engineering',
        description: 'We bring our vision for a human-centric service experience to life by developing, troubleshooting, and building applications.',
        type: 'department',
        parent: 1,
        children: [8,9,10,11,12,13],
        lead: 1
    }

    const placeholderGroup: IGroup = {
        id: 8,
        name: 'Squad K',
        description: 'We train new engineers on modern engineering concepts so they can excel as developers.',
        type: 'team',
        parent: 7,
        children: [],
        lead: 1
    }
    const { id } = useParams();
    return(
        <>
            <KipsuAppBar />
            <h1>{id}</h1>
            <Footer />
        </>
    );
};
export default Group;