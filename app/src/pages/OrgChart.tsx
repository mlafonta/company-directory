import * as React from 'react';
import { Typography } from '@mui/material';
import OrgChartUserCard from '../components/OrgChartUserCard';
import { Tree } from 'react-organizational-chart';

const OrgChart = () => {
    return (
        <Tree
            lineWidth={'5px'}
            lineColor={'#195CAB'}
            lineBorderRadius={'10px'}
            label={
                <Typography variant="h2" style={{ marginTop: 10 }}>
                    Kipsu Org Chart
                </Typography>
            }
        >
            <OrgChartUserCard userId={1} />
        </Tree>
    );
};
export default OrgChart;
