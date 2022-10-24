import { createApi, fetchBaseQuery } from '@reduxjs/toolkit/query/react';
import { IGroup } from '../models/IGroup';
import { IResource } from '../models/IResource';
import { IUser } from '../models/IUser';

const BASE_URL = 'http://localhost:8000/api/v1';

export const api = createApi({
    reducerPath: 'api',
    baseQuery: fetchBaseQuery({ baseUrl: BASE_URL }),
    tagTypes: ['Resource', 'Group', 'User'],
    endpoints: (builder) => ({
        getGroups: builder.query<IGroup[], undefined>({
            query: () => `/groups`,
            providesTags: ['Group'],
        }),
        getGroup: builder.query<IGroup, number>({
            query: (groupId: number) => `/groups/${groupId}`,
            providesTags: ['Group'],
        }),
        getResources: builder.query<IResource[], undefined>({
            query: () => `/resources`,
            providesTags: ['Resource'],
        }),
        getResourcesByGroup: builder.query<IResource[], number>({
            query: (groupId: number) => `/groups/${groupId}/resources`,
            providesTags: ['Resource'],
        }),
        getUsers: builder.query<IUser[], undefined>({
            query: () => `/users`,
            providesTags: ['User'],
        }),
        getUser: builder.query<IUser, number>({
            query: (userId: number) => `/users/${userId}`,
            providesTags: ['User'],
        }),
        addResourceToGroup: builder.mutation<void, { resource: IResource; groupId: number }>({
            query: (arg) => ({
                url: `/groups/${arg.groupId}/resources`,
                method: 'POST',
                body: arg.resource,
            }),
            invalidatesTags: ['Resource'],
        }),
        updateResource: builder.mutation<void, IResource>({
            query: ({ id, ...rest }) => ({
                url: `/resources/${id}`,
                method: 'PUT',
                body: rest,
            }),
            invalidatesTags: ['Resource'],
        }),
        deleteResourceFromGroup: builder.mutation<void, { groupId: number; resourceId: number }>({
            query: (arg) => ({
                url: `/groups/${arg.groupId}/resources/${arg.resourceId}`,
                method: 'DELETE',
            }),
            invalidatesTags: ['Resource'],
        }),
    }),
});

export const {
    useGetGroupsQuery,
    useGetGroupQuery,
    useGetResourcesQuery,
    useGetResourcesByGroupQuery,
    useGetUsersQuery,
    useGetUserQuery,
    useAddResourceToGroupMutation,
    useUpdateResourceMutation,
    useDeleteResourceFromGroupMutation,
} = api;
