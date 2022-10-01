import {IUser} from "./IUser";

export interface IGroup {
    id?: number
    name?: string
    description?: string
    type?: string
    parent?: IGroup
    children?: Array<IGroup>
    members?: Array<IUser>
}