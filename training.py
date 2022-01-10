#! C:/Users/kenneth/AppData/Local/Programs/Python/Python37/python.exe
#!/usr/bin/env python
# coding: utf-8

# In[12]:


import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
from sklearn.feature_selection import SelectFromModel
from sklearn.tree import export_graphviz
import matplotlib.pyplot as plt
import joblib as joblib
# import seaborn as sns

score_data = pd.read_csv('demosaved.csv')

X = score_data.drop(columns=['RESULT'])
y = score_data['RESULT']

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2)

model = RandomForestClassifier(n_estimators = 100)

model.fit(X_train, y_train)
# print (y_test)
predictions = model.predict(X_test)

# predictions = model.predict([
#   [0,0,0]
# ])
score = accuracy_score(y_test, predictions)
# joblib.dump(model, 'student-assesstment.joblib')
model = joblib.load('student-assesstment.joblib')
print(predictions)
#print(score)

# Tree = model.estimators_[5]

# export_graphviz(
#   Tree,
#   out_file='student-assessment.dot',
#   feature_names=['Quiz1', 'Quiz2', 'Quiz3'],
#   class_names=sorted(y.unique()),
#   label='all',
#   rounded=True,
#   filled=True
# )
# import os
# os.environ["PATH"] += os.pathsep + 'D:/Program Files (x86)/Graphviz2.38/bin/'
# from graphviz import render
# render('dot', 'png', 'student-assessment.dot')


# %%
