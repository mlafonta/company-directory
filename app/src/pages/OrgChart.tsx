import * as React from 'react';
import { Grid } from '@mui/material';
import OrgChartUserCard from '../components/OrgChartUserCard';

const OrgChart = () => {
    return (
        <Grid container justifyContent="center" wrap="nowrap" overflow="auto">
            <OrgChartUserCard userId={1} />
        </Grid>
    );
};
export default OrgChart;
