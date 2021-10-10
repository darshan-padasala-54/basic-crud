const CompanyList = () => import('./components/company/list.vue');
const CompanyCreate = () => import('./components/company/create.vue');
const CompanyEdit = () => import('./components/company/edit.vue');

const EmployeeList = () => import('./components/employee/list.vue');
const EmployeeCreate = () => import('./components/employee/create.vue');
const EmployeeEdit = () => import('./components/employee/edit.vue');

export const routes = [
    {
        name: 'companyList',
        path: '/company',
        component: CompanyList
    },
    {
        name: 'companyCreate',
        path: '/company/create',
        component: CompanyCreate
    },
    {
        name: 'companyEdit',
        path: '/company/:id/edit',
        component: CompanyEdit
    },
    {
        name: 'employeeList',
        path: '/employee',
        component: EmployeeList
    },
    {
        name: 'employeeCreate',
        path: '/employee/create',
        component: EmployeeCreate
    },
    {
        name: 'employeeEdit',
        path: '/employee/:id/edit',
        component: EmployeeEdit
    }
]
