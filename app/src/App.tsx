import './styles/App.css';
import { BrowserRouter, Navigate, Route, Routes } from 'react-router-dom';
import Home from './pages/Home';
import * as React from 'react';
import OrgChart from './pages/OrgChart';
import AdminRequest from './pages/AdminRequest';
import Group from './pages/Group';
import User from './pages/User';
import { useGetGroupsQuery } from './redux/apiSlice';
import { useEffect } from 'react';
import { addGroups } from './redux/groupsSlice';
import { useAppDispatch } from './redux/hooks';

function App() {
    const { data: groupsData } = useGetGroupsQuery(undefined);
    const dispatch = useAppDispatch();
    useEffect(() => {
        dispatch(addGroups(groupsData ?? []));
    }, [groupsData]);

    return (
        <>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/org-chart" element={<OrgChart />} />
                    <Route path="/admin-request" element={<AdminRequest />} />
                    <Route path="/group/:id" element={<Group />} />
                    <Route path="/user/:id" element={<User />} />
                    <Route path="*" element={<Navigate to="/" replace />} />
                </Routes>
            </BrowserRouter>
        </>
    );
}

export default App;
