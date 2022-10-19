import { Autocomplete, TextField, Typography } from '@mui/material';
import { useGetUsersQuery } from '../apis/apiSlice';
import { useState } from 'react';
import { IUser } from '../models/IUser';
import { makeStyles } from '@mui/styles';

const useStyles = makeStyles(() => ({
    noOptions: {
        fontFamily: 'sans-serif',
    },
}));

const DynamicSearchBar = () => {
    const { data, isLoading, error } = useGetUsersQuery(undefined);
    const [inputValue, setInputValue] = useState<string>('');
    const [open, setOpen] = useState<boolean>(false);
    const styles = useStyles();
    const handleOpen = () => {
        if (inputValue.length > 0) {
            setOpen(true);
        }
    };
    const handleInputChange = (event: any, newInputValue: string) => {
        setInputValue(newInputValue);
        if (newInputValue.length > 0) {
            setOpen(true);
        } else {
            setOpen(false);
        }
    };

    return (
        <div>
            {isLoading && (
                <TextField
                    label="Loading Search..."
                    style={{ backgroundColor: '#bbb', fontFamily: 'Roboto', borderRadius: 5 }}
                    disabled
                />
            )}
            {!isLoading && !error && data && (
                <Autocomplete
                    classes={{
                        noOptions: styles.noOptions,
                    }}
                    id="search-bar"
                    open={open}
                    forcePopupIcon={false}
                    onOpen={handleOpen}
                    onClose={() => setOpen(false)}
                    onInputChange={handleInputChange}
                    style={{ width: 256, backgroundColor: '#FFF', borderRadius: 10 }}
                    options={data}
                    getOptionLabel={(option: IUser) => option.name || ''}
                    noOptionsText="No Users Found"
                    renderOption={(props, option: IUser) => (
                        <li {...props}>
                            <Typography variant="subtitle1">{option.name}</Typography>
                        </li>
                    )}
                    onChange={(event, value) => window.open(`/user/${value?.id}`, '_self')}
                    renderInput={(params) => (
                        <TextField
                            {...params}
                            label="Search Users"
                            style={{ fontFamily: 'Roboto', borderRadius: 5 }}
                            variant="filled"
                            InputProps={{ ...params.InputProps, disableUnderline: true }}
                        />
                    )}
                />
            )}
        </div>
    );
};
export default DynamicSearchBar;
