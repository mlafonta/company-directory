import './styles/App.css';
import {BrowserRouter, Routes, Route, Navigate} from "react-router-dom";
import Home from "./pages/Home";
import * as React from "react";
import OrgChart from "./pages/OrgChart";
import AdminRequest from "./pages/AdminRequest";
import Group from "./pages/Group";

function App() {
  return (
      <BrowserRouter>
        <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/org-chart" element={<OrgChart />} />
            <Route path="/admin-request" element={<AdminRequest />} />
            <Route path="/group/:id" element={<Group />} />
            <Route path="*" element={<Navigate to="/" replace />} />
        </Routes>
      </BrowserRouter>

  )
}

export default App;