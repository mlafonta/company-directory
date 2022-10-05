import {Box, Link, Paper, Typography} from "@mui/material";

const Footer = () => {
    return (
        <Paper sx={{
            width: '100%',
            position: 'fixed',
            bottom: 0,
            alignItems: "baseline"
        }} component="footer">
            <Box
                sx={{
                    justifyContent: "right",
                    display: "flex",
                    margin: "20px"
                }}
            >
                <Typography variant="h6">
                    Need Extra Help?
                </Typography>
                &nbsp;
                {/*<Link href="/admin-request">*/}
                <Link href="mailto:mlafontant@kipsu.com?subject=Company%20Directory%20Request">
                    <Typography variant="h6">
                        Contact Admin
                    </Typography>
                </Link>
            </Box>
        </Paper>
    );
}

export default Footer;