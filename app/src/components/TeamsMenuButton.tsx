import {CircularProgress, ClickAwayListener, Grow, ListSubheader, MenuList, Paper, Popper} from "@mui/material";
import MenuItem from "@mui/material/MenuItem";
import * as React from "react";
import '../styles/AppBar.css';
import {ExpandLess, ExpandMore} from "@mui/icons-material";
import Button from "@mui/material/Button";
import {IGroup} from "../models/IGroup";
import useAxiosFunction from "../hooks/useAxiosFunction";
import axios from '../apis/companyDirectoryServer'
import {useEffect} from "react";

const TeamsMenuButton = () => {
    const [anchorEl, setAnchorEl] = React.useState<null | HTMLElement>(null);
    const [open, setOpen] = React.useState<boolean>(false);
    const [response, error, loading, axiosFetch] = useAxiosFunction();
    let teams: IGroup[] = [];
    let departments: IGroup[] = [];
    const handleClick = (event: React.MouseEvent<HTMLButtonElement>) => {
        setAnchorEl(event.currentTarget);
        setOpen(true);
    };
    const handleClose = () => {
        setOpen(false);
    };

    const getData = () => {
        // @ts-ignore
        axiosFetch({
            axiosInstance: axios,
            method: 'GET',
            url: '/groups'
        });
    }

    useEffect(() => {
        getData();
    }, []);

    if (!loading && !error && response) {
        // @ts-ignore
        response.forEach((item: IGroup) => {
            if (item.type == 'team') {
                teams.push(item);
            } else if (item.type == 'department') {
                departments.push(item);
            }
        })
    }

    // @ts-ignore
    return (
        <>
            {loading &&
                <Button
                    disabled
                    className="text"
                    sx={{my: 2, color: 'inherit', display: 'flex'}}
                >
                    Teams
                    <ExpandMore/>
                </Button>}
            {!loading && !error && response && <>
                <Button
                    className="text"
                    onClick={handleClick}
                    sx={{my: 2, color: 'white', display: 'flex'}}
                >
                    Teams
                    {open ? <ExpandLess/> : <ExpandMore/>}
                </Button>
                <Popper
                    open={open}
                    anchorEl={anchorEl}
                    placement="bottom-start"
                    transition
                    disablePortal
                >
                    {({TransitionProps, placement}) => (
                        <Grow
                            {...TransitionProps}
                            style={{
                                transformOrigin:
                                    placement === 'bottom-start' ? 'left top' : 'left bottom',
                            }}
                        >
                            <Paper className="menu" style={{maxHeight: 375, overflow: 'auto'}} elevation={3}>
                                <ClickAwayListener onClickAway={handleClose}>
                                    <MenuList
                                        autoFocusItem={open}
                                        id="composition-menu"
                                        aria-labelledby="composition-button"
                                    >
                                        {departments.map((department) => (
                                            <div key={department.id}>
                                                <MenuItem className="group-menu-header" key={department.id}
                                                          component="a"
                                                          href={`/group/${department.id}`}>{department.name}</MenuItem>
                                                <li>
                                                    {teams.filter(team => team?.parent?.id == department.id).map(filteredTeam => (
                                                        <MenuItem className="team-menu-text" key={filteredTeam.id}
                                                                  component="a"
                                                                  href={`/group/${filteredTeam.id}`}>{filteredTeam.name}</MenuItem>
                                                    ))}
                                                </li>
                                            </div>
                                        ))}
                                    </MenuList>
                                </ClickAwayListener>
                            </Paper>
                        </Grow>
                    )}
                </Popper>
            </>}
        </>
    );
};

export default TeamsMenuButton;