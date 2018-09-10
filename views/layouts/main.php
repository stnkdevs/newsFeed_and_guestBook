<?php $this->beginPage() ?>
<html>
<head>
<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<script>
    var dd, dd2;
    $(document).ready(function(){
    qst=new RQuestion({
    id: 0,
    alternatives: [ {id: 1, content: 'London', title: 'A'}, {id: 2, content: 'Kiev', title: 'B'}, {id: 3, content: 'Aphiny', title: 'C'}, {id: 4, content: 'Varshava', title: 'D'} ],
    items: [ {id: 1, content: 'Ukraine', title: 1}, {id: 2, content: 'Poland', title: 2}, {id: 3, content: 'Greece', title: 3} ],
    question: {id: 1, content: "Question...", 'title': 'xx'}
    });
    
    /* 
    var mlist=new List({equals: null});
    mlist.newItem(1);
    mlist.newItem(2);
    var blist=new ListLayout(mlist, 'changed');
    blist.itemHtml=function(obj, details){
        return `<a href="#" class="list-group-item  x-list-item" data-id="${obj}">N #${obj}</a>`;    
    };
    blist.renderAt($(document).find('.bindlist'));
    alert('ADD THIRS..');
    mlist.newItem(3);
    alert('RM 1');
    mlist.removeItem(1);
    */
    
    dd=function (){
        var editor=QuestionEdit.getById('0*');
        editor.setQuestion(qst);
    };
    dd2=function(){
        
        var editor=QuestionEdit.getById(0);
        var qpanel=editor.qpanel;
        console.log(qpanel.getSelected());
        alert('See console');
    };
    dd3=function(){
        var editor=QuestionEdit.getById(0);
        var qpanel=editor.qpanel;
        var qst=editor.question;
        qst.removeItem(qpanel.getSelected()[0]);
    };
    });
</script>
</body>
</html>
<?php $this->endPage() ?>