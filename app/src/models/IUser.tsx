import { IGroup } from './IGroup';

export interface IUser {
    id?: number;
    name?: string;
    email?: string;
    pronouns?: string;
    image?: string;
    position?: string;
    group?: IGroup;
    timeAtKipsu?: string;
    slackLink?: string;
    // socialQuestions: string[]
    // socialQuestionAnswers: string[]
    lead?: boolean;
    supervisor?: IUser;
    reports?: IUser[];
}
