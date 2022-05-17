import ConfirmBox from '../helpers/ConfirmBox.js';

export const tableData = {
    props: ['headline'],
    data() {
        return {
            componentData: [],
            multiSelection: [],
            isAll: '',
            showAlert: false,
            pagination: {},
            alertType: '',
            alertText: '',
            searchQuery: '',
            showpages: 10,
            showLoader: false
        };
    },
    methods: {
        resetAlert() {
            this.alertType = '';
            this.alertText = '';
            this.showAlert = false;
        },
        alertHandler(type, text, isShow) {
            this.alertType = type;
            this.alertText = text;
            this.showAlert = isShow;
        },
        toggleAll() {
            if (this.isAll == true) {
                this.componentData.map((ele) => {
                    this.multiSelection.push(ele.id);
                })
            } else {
                this.componentData.map((ele) => {
                    this.multiSelection.pop(ele.id);
                })
            }
        },
        resetMultiSelection() {
            this.multiSelection = [];
            this.isAll = false;
        },
        removeConfirm(obj) {
            let confirmBox = new ConfirmBox(this);
            confirmBox
                .removeBox(this.headline, `You will not be able to recover this ${this.headline}!`, obj);
        },
        removeBulkConfirm() {
            let confirmBox = new ConfirmBox(this);
            confirmBox
                .bulkRemoveBox(this.headline, `You will not be able to recover this ${this.headline}!`);
        },
        switchStatusBulkConfirm() {
            let confirmBox = new ConfirmBox(this);
            confirmBox
                .bulkStatusBox(this.headline, `You will be able to restore selected ${this.headline} state!`);
        },
        nextPage() {
            let pagination = this.pagination;
            if (pagination.current_page < pagination.total_pages) {
                let reqPage = pagination.current_page + 1;
                this.all(reqPage);
            }
        },
        prevPage() {
            let pagination = this.pagination;
            if (pagination.current_page > 1) {
                let reqPage = pagination.current_page - 1;
                this.all(reqPage);
            }
        },
        sortBy(cols) {
            if (this.escapeSort.indexOf(cols) < 0) {
                if (cols == this.sortOrder.field) {
                    this.sortOrder.order = (this.sortOrder.order == 'asc') ? 'desc' : 'asc';
                } else {
                    this.sortOrder = { field: cols, order: 'asc' };
                }
                this.all(this.pagination.current_page);
            }
        },
        searchChanges() {
            let searchQuery = this.searchQuery;
            if (searchQuery == "") {
                this.all();
            }
        },
    },
    computed: {
        paginationList() {

            let last = this.pagination.total_pages;
            let current = this.pagination.current_page;
            let showing = this.showpages;
            let canShow = (this.pagination.current_page + this.showpages) - 1;
            if (canShow < last) {
                return canShow;
            }
            return last;
        }
    },
    filters: {
        capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1)
        },
    }
};
