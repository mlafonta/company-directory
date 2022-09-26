export interface IGroup {
    id: number
    name: string
    description: string
    type: string
    parent: number
    children: Array<number>
    lead: number
}