export interface Group {
    id: number
    name: string
    description: string
    type: string
    parent: number
    children: Array<number>
}