<h2><?php e(h($wiki->pretty_title($page['Page']['title']))); ?></h2>
<?php e($form->create('WikiContent',
                      aa('url',
                         array('controller' => 'wiki',
                               'action' => 'edit',
                               'project_id' => $main_project['Project']['identifier'],
                               'wikipage' => $page['Page']['title'],
                               /* formヘルパがedit時にidを上書きするのを禁止するためのtrick */
                               'id' => null)))); ?>
<?php e($form->hidden('version')); ?>
<?php /* $candy->error_messages_for 'content'*/ ?>
<p><?php e($form->input('WikiContent.text',
                        array('type' => 'textarea',
                              'cols' => 100,
                              'rows' => 25,
                              'class' => 'wiki-edit',
                              'label' => false,
                              'div' => false,
                              /*'accesskey' => accesskey(:edit)*/ ))) ?></p>
<p><label><?php __("Comment"); ?></label><br />
<?php e($form->input('WikiContent.comments',
                     array('type' => 'text',
                           'size' => 120,
                           'label' => false,
                           'div' => false))); ?></p>
<p><?php e($form->submit(__("Save", true),
                         aa('div', false))); ?>
<?php e($ajax->link(__('Preview', true),
                    array('controller' => 'wiki',
                          'action' => 'preview',
                          'project_id' => $main_project['Project']['identifier'],
                          'wikipage' => $page['Page']['title']),
                    array('method' => 'post',
                          'update' => 'preview',
                          'with' => "Form.serialize('wiki_form')",
                          'complete' => "Element.scrollTo('preview')")));
/*}, :accesskey => accesskey(:preview)*/ ?></p>
<?php /*wikitoolbar_for 'content_text'*/ ?>
<?php $form->end() ?>

<div id="preview" class="wiki"></div>

<?php $this->set('header_tags', $html->css('scm')) ?>

<?php $candy->html_title(h($wiki->pretty_title($page['Page']['title']))); ?>
