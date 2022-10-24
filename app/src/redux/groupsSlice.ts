import type { PayloadAction } from '@reduxjs/toolkit';
import { createSlice } from '@reduxjs/toolkit';
import { IGroup } from '../models/IGroup';

export interface GroupsState {
    groups: IGroup[];
}

const initialState: GroupsState = {
    groups: [],
};

export const groupsSlice = createSlice({
    name: 'groups',
    initialState,
    reducers: {
        addGroups: (state, action: PayloadAction<IGroup[]>) => {
            state.groups = action.payload;
        },
    },
});

export const { addGroups } = groupsSlice.actions;

export default groupsSlice.reducer;
