import { configureStore, ThunkAction, Action } from '@reduxjs/toolkit';
import { api } from './apiSlice';
import groupsReducer from './groupsSlice';

export const store = configureStore({
    reducer: {
        [api.reducerPath]: api.reducer,
        groups: groupsReducer,
    },
    middleware: (getDefaultMiddleware) => getDefaultMiddleware().concat(api.middleware),
});

export type AppDispatch = typeof store.dispatch;
export type RootState = ReturnType<typeof store.getState>;
export type AppThunk<ReturnType = void> = ThunkAction<ReturnType, RootState, unknown, Action<string>>;
