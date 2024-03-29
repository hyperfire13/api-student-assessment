#! C:/Users/WINDOWS/AppData/Local/Programs/Python/Python37/python.exe
#!/usr/bin/env python
# coding: utf-8

import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
from sklearn.feature_selection import SelectFromModel
from sklearn.tree import export_graphviz
import seaborn as sns
import numpy as np
import matplotlib.pyplot as plt
import joblib as joblib
import sys
import os
import json

this_dir = os.path.dirname(__file__)
model = joblib.load(this_dir + '/new-college-progression.joblib')
score_data = pd.read_csv('../upload/converted/' + sys.argv[1])
original_data = pd.read_csv('../upload/' + sys.argv[2])
for i in range(len(score_data)):
  predictions = model.predict([
    [score_data.values[i][2],
    score_data.values[i][3],
    score_data.values[i][4],
    score_data.values[i][5],
    score_data.values[i][6],
    score_data.values[i][7],
    score_data.values[i][8],
    score_data.values[i][9],
    score_data.values[i][10],
    score_data.values[i][11],
    score_data.values[i][12],
    score_data.values[i][13],
    score_data.values[i][14],
    score_data.values[i][15],
    ]
  ])
  # score_data.values[i][12] = predictions[0]
  # score_data.set_value(i, 'CONTINUE/STOP', predictions[0])
  score_data.loc[i, 'CONTINUE/STOP'] = predictions[0]
  original_data.loc[i, 'CONTINUE/STOP'] = predictions[0]


score_data.to_csv('../upload/result/resulted-' + sys.argv[1], encoding='utf-8', index=False)
original_data.to_csv('../upload/final/final-' + sys.argv[2], encoding='utf-8', index=False)

imp = model.feature_importances_
#Create arrays from feature importance and feature names
X = score_data.drop(columns=['CONTINUE/STOP', 'Section', 'Student Number '])
feature_importance = np.array(imp)
feature_names = np.array(X.columns)

#Create a DataFrame using a Dictionary
data={'feature_names':feature_names,'feature_importance':feature_importance}
fi_df = pd.DataFrame(data)
fi_df.sort_values(by=['feature_importance'], ascending=False,inplace=True)
# original_data.loc[i, 'FACTOR1'] = fi_df.iloc[0][0]
# original_data.loc[i, 'FACTOR2'] = fi_df.iloc[1][0]
# original_data.loc[i, 'FACTOR2'] = fi_df.iloc[3][0]
json.dumps([
  'final-' + sys.argv[2], 
  {'factors': (fi_df.iloc[0][0], fi_df.iloc[1][0], fi_df.iloc[3][0])}])

print(json.dumps([
  'final-' + sys.argv[2], 
  {'factors': (fi_df.iloc[0][0], fi_df.iloc[1][0], fi_df.iloc[3][0])}]))
